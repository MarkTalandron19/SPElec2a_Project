<?php

declare(strict_types=1);

class LibraryORM
{
    private $dbString = '';
    private $table = '';
    private $whereClause = '';
    private $connection = null;
    public function __construct(string $dbDriver, string $userName, string $passWord, bool $verbose)
    {
        try {
            $this->connection = new PDO($dbDriver, $userName, $passWord);
            if ($verbose) {
                echo 'Databases Connected.';
            }
        } catch (PDOException $e) {
            echo 'Error encountered. ' . $e->getMessage();
        }
    }

    public function select(array $fields = null): object
    {
        $this->dbString .= 'SELECT ';

        if ($fields === null) {
            $fields = '* ';
            $this->dbString .= $fields;
        } else {
            $arrayCount = count($fields) - 1;
            $counter = 0;
            foreach ($fields as $field) {
                $this->dbString .= $field;
                if ($counter < $arrayCount) {
                    $this->dbString .= ', ';
                    $counter++;
                }
            }

            return $this;
        }

        return $this;
    }

    public function from(string $tableName): object
    {
        $this->dbString .= ' FROM ' . $tableName . ' ';

        return $this;
    }

    public function showQuery(): string
    {
        return $this->dbString;
    }

    public function getAll(): array
    {
        $query = $this->dbString;

        $statement = $this->connection->query($query);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->dbString = '';
        $this->table = '';
        $this->whereClause = '';

        return $results;
    }

    public function get(): array
    {
        if ($this->whereClause != '') {
            $this->dbString .= $this->whereClause;
        }
        $query = $this->dbString;

        $statement = $this->connection->query($query);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->dbString = '';
        $this->table = '';
        $this->whereClause = '';

        return $results;
    }

    public function printRows(array $arr)
    {
        echo '<table>';
        echo '<tr>';
        foreach (array_keys($arr[0]) as $header) {
            echo '<th>' . $header . '</th>';
        }
        echo '</tr>';

        foreach ($arr as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }

    public function table(string $table): object
    {
        $this->table = $table;
        return $this;
    }

    public function insert(array $arr): array
    {
        $fields = implode(", ", array_keys($arr));
        $placeholders = implode(',', array_fill(0, count($arr), '?'));

        $query = "INSERT INTO $this->table ($fields) VALUES ($placeholders)";
        $statement = $this->connection->prepare($query);
        $statement->execute(array_values($arr));
        // $this->dbString = '';
        // $this->dbString = 'SELECT * FROM ' . $this->table;

        // $query = $this->dbString;

        // $statement = $this->connection->query($query);
        // $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        // $this->dbString = '';
        $this->table = '';
        return [];
    }

    public function insertHold(array $arr): array
    {
        $query = "INSERT INTO holds (holdID, bookID, branchID, patronID, holdDate)
            VALUES (:holdID, :bookID, :branchID, :patronID, :holdDate)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':holdID', $arr['holdID'], PDO::PARAM_INT);
        $stmt->bindValue(':bookID', $arr['bookID'], PDO::PARAM_INT);
        $stmt->bindValue(':branchID', $arr['branchID'], PDO::PARAM_INT);
        $stmt->bindValue(':patronID', $arr['patronID'], PDO::PARAM_INT);
        $stmt->bindValue(':holdDate', $arr['holdDate'], PDO::PARAM_STR);
        $stmt->execute($arr);
        return [];
    }

    public function where(string $attribute, string $value): object
    {
        $temp = "\"$value\"";
        $this->whereClause .= 'WHERE ' . $attribute . ' = ' . $temp;

        return $this;
    }
    public function and(string $attribute, string $value): object
    {
        $temp = "\"$value\"";
        $this->whereClause .= ' AND ' . $attribute . ' = ' . $temp;

        return $this;
    }

    public function update(array $arr): array
    {
        $setClause = implode('=?, ', array_keys($arr)) . '=?';
        $query = "UPDATE $this->table SET $setClause ";
        if ($this->whereClause != '') {
            $query .= $this->whereClause;
        }
        $statement = $this->connection->prepare($query);
        $params = array_values($arr);
        $statement->execute($params);
        $this->dbString = '';
        $this->dbString = 'SELECT * FROM ' . $this->table;

        $query = $this->dbString;

        $statement = $this->connection->query($query);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->dbString = '';
        $this->table = '';
        $this->whereClause = '';

        return $results;
    }

    public function delete(): array
    {
        $this->dbString .= ' DELETE FROM ' . $this->table;
        if ($this->whereClause != ' ') {
            $this->dbString .= ' ' . $this->whereClause;
        }

        $query = $this->dbString;
        echo $query;

        $statement = $this->connection->prepare($query);
        $statement->execute();
        $this->dbString = '';
        $this->dbString = 'SELECT * FROM ' . $this->table;

        $query = $this->dbString;

        $statement = $this->connection->prepare($query);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->dbString = '';
        $this->table = '';
        $this->whereClause = '';

        return $results;
    }

    public function getBooksPerBranch(): array
    {
        $query = "SELECT branchName AS `Branch Name`, 
        title AS `Title`, 
        author AS `Author`, 
        pubYear AS `Publication Year`, 
        isbn AS `ISBN`, 
        copiesAvailable AS `Available Copies`, 
        available AS `Available`,
        bookID,
        br.branchID 
        FROM branches br 
        JOIN books b 
        ON br.branchID = b.branchID
        ORDER BY branchName";

        $statement = $this->connection->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getUserLoans($patronID): array
    {
        $query = "select l.bookID, title from books b inner join loans l 
        on b.bookID = l.bookID inner join patrons p on l.patronID = p.patronID
        and l.patronID = $patronID";

        $statement = $this->connection->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}

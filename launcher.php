<?php
require_once('LibraryORM.php');

$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);


/**Insert Operations */

// (1, 1234567891, 1, 1, '2022-05-09', '2022-05-16', '2022-05-23'),
$arr = [
    'loanID' => 1,
    'bookID' => 1234567891,
    'branchID' => 1, 
    'patronID' => 2, 
    'loanDate' => '2022-05-09', 
    'dueDate' => '2022-05-10',
    'returnDate' => null
];
$result = $db->table('loans')->insert($arr);
// $loan = $db->table('holds')->insert($arr);   
// $arr = []; // For insertions
// $book = $db->table('books')->insert($arr); //Add book
// $periodical = $db->table('periodicals')->insert($arr); //Add periodical
// $branch = $db->table('branches')->insert($arr);  //Add branch 
// $patron = $db->table('patrons')->insert($arr); //Add patron
// $loan = $db->table('loans')->insert($arr); //Add loan
// $fine = $db->table('fines')->insert($arr);  //Add fine
// $hold = $db->table('holds')->insert($arr); //Add hold  
// $transfer = $db->table('transfers')->insert($arr); //Add transfer
// $video = $db->table('videos')->insert($arr); //Add video
// $cd = $db->table('cds')->insert($arr); //Add cd

/**Full Retrieval Operations */
// $books = $db->select()->from('books')->getAll(); //Get books
// $periodicals = $db->select()->from('periodicals')->getAll(); //Get periodicals
// $branches = $db->select()->from('branches')->getAll();  //Get branches 
// $patrons = $db->select()->from('patrons')->getAll(); //Get patrons
// $loans = $db->select()->from('loans')->getAll(); //Get loans
// $fines = $db->select()->from('fines')->getAll();  //Get fines
// $holds = $db->select()->from('holds')->getAll(); //Get holds  
// $transfers = $db->select()->from('transfers')->getAll(); //Get transfers
// $videos = $db->select()->from('videos')->getAll(); //Get videos
// $cds = $db->select()->from('cds')->getAll(); //Get cds
// $db->printRows($books);

/**Update Operations */
// $update = []; // For insertion
// $attribute; // Column Name
// $value; // Row Value
// $book = $db->table('books')->where($attribute, $value)->update($update); // Update book
// $branch = $db->table('brances')->where($attribute, $value)->update($update);  //Update branch 
// $patron = $db->table('patrons')->where($attribute, $value)->update($update); //Update patron
// $loan = $db->table('loans')->where($attribute, $value)->update($update); //Update loan
// $fine = $db->table('fines')->where($attribute, $value)->update($update);  //Update fine
// $hold = $db->table('holds')->where($attribute, $value)->update($update); //Update hold  
// $transfer = $db->table('transfers')->where($attribute, $value)->update($update); //Update transfer
// $video = $db->table('videos')->where($attribute, $value)->update($update); //Update video
// $cd = $db->table('cds')->where($attribute, $value)->update($update); //Update cd

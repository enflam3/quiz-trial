<?php
    session_start();
    //Extended php CRUD library for DATABASE management
    //Used in Ranking and Admin sections
    
    //PHP charset UTF-8
    header('Content-Type: text/html; charset=utf-8');

    //Topics table
    include('xcrud/xcrud.php');
    $xcrud_topics = Xcrud::get_instance();
    $xcrud_topics->table('topics');
    $xcrud_topics->unset_view();
    $xcrud_topics->unset_csv();
    $xcrud_topics->unset_search();
    $xcrud_topics->unset_print();
    $xcrud_topics->hide_button('save_new');
    $xcrud_topics->hide_button('save_edit');

    //Heroes table
    $xcrud_heroes = Xcrud::get_instance();
    $xcrud_heroes->table('heroes');
    $xcrud_heroes->unset_add();
    $xcrud_heroes->unset_view();
    $xcrud_heroes->unset_csv();
    $xcrud_heroes->unset_search();
    $xcrud_heroes->unset_print();
    $xcrud_heroes->hide_button('save_new');
    $xcrud_heroes->hide_button('save_edit');
    $xcrud_heroes->column_cut(20,'name');
    $xcrud_heroes->column_cut(10,'test');
    $xcrud_heroes->column_cut(10,'quest');
    $xcrud_heroes->column_cut(10,'points');
    $xcrud_heroes->order_by('points','desc');
    
    //Questions and choices
    $xcrud_quests = Xcrud::get_instance();
    $xcrud_quests->table('quests');
    $xcrud_quests->unset_view();
    $xcrud_quests->unset_csv();
    $xcrud_quests->unset_search();
    $xcrud_quests->unset_print();
    $xcrud_quests->hide_button('save_new');
    $xcrud_quests->hide_button('save_edit');
    $xcrud_quests->unset_pagination();
    $xcrud_quests->column_cut(20,'question');
    $xcrud_quests->column_cut(10,'choices');
    $xcrud_quests->column_cut(10,'correct');
    $xcrud_quests->validation_pattern('question', '^[a-zA-Z0-9 -=!%<>@#$&(),.?]*$');
    $xcrud_quests->validation_pattern('choices', '^[a-zA-Z0-9 -=!%<>@#$&(),.?]*$');
    $xcrud_quests->validation_pattern('correct', '^[a-zA-Z0-9 -=!%<>@#$&(),.?]*$');
    $xcrud_quests->validation_pattern('topic', '^[a-zA-Z0-9 -=!%<>@#$&(),.?]*$');
    
    //Ranking table as view only
    $xcrud_lederboard = Xcrud::get_instance();
    $xcrud_lederboard->table('heroes');
    $xcrud_lederboard->unset_add();
    $xcrud_lederboard->unset_edit();
    $xcrud_lederboard->unset_remove();
    $xcrud_lederboard->unset_view();
    $xcrud_lederboard->unset_csv();
    $xcrud_lederboard->unset_search();
    $xcrud_lederboard->unset_print();
    $xcrud_lederboard->unset_pagination();
    $xcrud_lederboard->columns('name,test,points'); 
    $xcrud_lederboard->order_by('points','desc');

?>

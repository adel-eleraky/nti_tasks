<?php
// dynamic table => 3 levels only
// dynamic rows //4 
// dynamic columns // 4
// check if gender of user == m ==> male // 1
// check if gender of user == f ==> female // 1

$users = [
    (object)[
        'id' => 1,
        'name' => 'ahmed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'football', 'swimming', 'running',
        ],
        'activities' => [
            "school" => 'drawing',
            'home' => 'painting'
        ],
        'phones'=>"0123123",
    ],
    (object)[
        'id' => 2,
        'name' => 'mohamed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'swimming', 'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        'phones'=>"2345",
    ],
    (object)[
        'id' => 3,
        'name' => 'menna',
        "gender" => (object)[
            'gender' => 'f'
        ],
        'hobbies' => [
            'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        'phones'=>"",
    ]
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="table.css">
    <title>Document</title>
</head>
<body>
<table class="table">
    <thead>
        <tr>
            <?php foreach($users[0] as $key1=>$value1){?>
                <th><?php echo $key1; ?></th>
            <?php }?>
        </tr>
    </thead>
    <tbody>
        <?php  foreach($users as $key2=>$value2){ ?>
            <tr>
                <?php foreach($users[$key2] as $key3=>$value3){ ?>
                    <td>
                        <?php   if(gettype($value3) === "string" || gettype($value3) === "integer"){
                                    echo $value3;
                                }
                                else{
                                    foreach($value3 as $index4=>$value4){
                                        if ($value4 ===  'm' ){
                                            echo "male";
                                        }
                                        elseif($value4 === 'f'){
                                            echo "female";
                                        }
                                        else{
                                            echo $value4 ."<br>";
                                        } 
                                }
                        }?>
                    </td>
                <?php } ?>
            </tr>
        <?php }?>
    </tbody>
</table>
</body>
</html>
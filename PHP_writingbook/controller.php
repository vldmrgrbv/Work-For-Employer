<?php
    namespace CONTROLLER;

    class ConnectionToDatabase {

        public function connection() {

            require 'model.php';

            $link = mysqli_connect($host, $user, $password, $database)
                or die("Ошибка " . mysqli_error($link));

            return $link;
        }       
    }

    class Autorization
    {

        public function __construct() {

                if (!isset($_SESSION['login']) || !isset($_SESSION['password'])) {

                $database = new ConnectionToDatabase();
                $link = $database->connection();

                $query = "SELECT * FROM user_data";
                $result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));

                $array_data = array();

                // getting arrays of usernames and passwords
                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $login = $row['login'];
                    $password = $row['password'];
                    $array_data[] = array(
                        "login" => "$login",
                        "password" => "$password",
                    );
                    $i++;
                }

                $check_login = false;
                $check_password = false;

                $login_request = $_REQUEST['login'];
                $password_request = $_REQUEST['password'];

                if (isset($login_request) && isset($password_request)) {
                    if (!empty($login_request)) {
                        if (!empty($password_request)) {
                            foreach ($array_data as $nested_array) {
                                if ($login_request === $nested_array['login']) {
                                    $check_login = true;
                                    // function password_verify - Checks if the password matches the hash
                                    if (password_verify($password_request, $nested_array['password'])) { 
                                        $check_password = true;
                                        $_SESSION['login'] = $nested_array['login'];
                                        $_SESSION['password'] = $nested_array['password'];
                                        $_SESSION['admin'] = false;
                                        break;
                                    }
                                }                   
                            }
                            if ($check_login == false) {
                                echo "<a href='login.php'><---Назад</a><br>";
                                exit("Ошибка! Логин не найден!");
                            }
                            if ($check_password == false) {
                                echo "<a href='login.php?login=$login_request'><---Назад</a><br>";
                                exit("Ошибка! Пароль введён не правильно!");
                            }

                        }  else {
                            echo "<a href='login.php?login=$login_request'><---Назад</a><br>";
                            exit("Ошибка! Пароль не введён!");
                             }
                    } else {
                            echo "<a href='login.php'><---Назад</a><br>";
                            exit("Ошибка! Логин не введён!");
                        } 
                }    else {
                        echo "<a href='login.php'><---Назад</a><br>";
                        exit("Логин(Пароль) не найдены!");
                    }
            }           
        }
    }

    class Autoriz_Client {

        public function processing_cl() {           
            if(isset($_REQUEST['login'])) {
                $login = $_SESSION['login'];
                echo "Здравствуйте, $login!</br>";
                echo "<a href='login.php'>Выход</a> ";
                echo "<a href='records.php'>Записи</a>";
            }
            elseif(isset($_SESSION['login'])) {
                $ses = $_SESSION['login'];
                echo "$ses</br>";
                echo "<a href='login.php'>Выход</a> ";
                echo "<a href='records.php'>Записи</a>";
            }
        }
    }
    // // admin verification code

    // class Autoriz_Admin {
    //     public function processing_ad() {
    //         if(isset($_SESSION['login']) && isset($_REQUEST['login'])) {
    //             $login = $_SESSION['login'];
    //             echo "</br>Приветствуем вас, уважаемый АДМИН!</br>";
    //             echo "<a href='login.php'>Выход</a> ";
    //             echo "<a href='data_admin.php'>Пользователи</a>";
    //         }
    //         elseif(isset($_SESSION['login'])) {
    //             $ses = $_SESSION['login'];
    //             echo "$ses!</br>";
    //             echo "<a href='login.php'>Выход</a> ";
    //             echo "<a href='data_admin.php'>Пользователи</a>";
    //         }
    //     }
    // }
    
    class Autoriz_Types extends Autorization {

        public function processing() {

            if(isset($_SESSION['login'])) {
                if($_SESSION['admin'] == false) {
                    $a = new Autoriz_Client();
                    $a -> processing_cl();
                }
                elseif($_SESSION['admin'] == true) {
                    $a = new Autoriz_Admin();
                    $a -> processing_ad();
                }
                else {
                    echo "Введены некорректные данные!</br>";
                    echo "<a href='views/login.php'>Авторизация</a>";
                }
            }
            else {
                echo "Авторизируйтесь!</br>";
                echo "<a href='login.php'>Авторизация</a>";
            }
        }
    }

    class Login
    {
        //destroy SESSIONs
        function login() {

            if(isset($_SESSION['login'])) {
                $_SESSION = [];
                unset($_COOKIE[session_name()]);
                session_destroy();
            }
        }

        public function get_login() {
            // when checking in authorization, so as not to re-enter the login
            if (isset($_GET['login'])) {
                return $_GET['login'];
            }

        }
    }    
    // // for admin
    // class Data_Admin
    // {
    //     function check() {
    //         require "model.php"; 
    //         $i = 1;
    //         foreach($users as $key=>$value)
    //             if(isset($_REQUEST['name_$i']) && $users["$key"]['admin'] == false) {
    //                 $users["$key"] = $_REQUEST['name_$i'];
    //                 $users["$key"]["balance"] = $_REQUEST['balance_$i'];
    //                 $i++;
    //             };
    //     }
    // }

    class Registration
    {

        public $data_check;

        public function __construct() {

            $this->data_check = new DataCheck();

        } 

        public function get_name() {

            $data_check = $this->data_check; // property class (data_check)

            return $data_check->clean($_POST['first_name']);

        }

        public function get_data() {

            $data_check = $this->data_check; // property class (data_check)

            $array_data[] = $data_check->clean($_POST['first_name']);
            $array_data[] = $data_check->clean($_POST['second_name']);
            $array_data[] = $data_check->clean($_POST['login']);
            $array_data[] = $data_check->clean($_POST['e_mail']);

            return $array_data;

        }

        public function data_checking()
        {
        
            $database = new ConnectionToDatabase();
            $link = $database->connection();

            $data_check = $this->data_check; // property class (data_check)

            // clean
             $fst_name = $data_check->clean($_POST['first_name']);
             $sec_name = $data_check->clean($_POST['second_name']);
             $password = $_POST['password'];
             $password_rep = $_POST['password_rep'];
             $login = $data_check->clean($_POST['login']);
             $e_mail = $data_check->clean($_POST['e_mail']);

            // check_length
             $i_1_res = '';
             $i_2_res = '';
             $i_3_res = '';
             $i_4_res = '';
             $i_5_res = '';
             if (!empty($fst_name)) {
                $i_1 = $data_check->check_length($fst_name, 2, 20);
                 if($i_1 == false) $i_1_res = "- Имя менее 2 или более 20 символов<br>";
             }
             if (!empty($sec_name)) {
                $i_2 = $data_check->check_length($sec_name, 2, 30);
                if($i_2 == false) $i_2_res = "- Фамилия менее 2 или более 30 символов<br>";
            }
             if (!empty($login)) {
                $i_3 = $data_check->check_length($login, 5, 30);
                if($i_3 == false) $i_3_res = "- Логин менее 5 или более 30 символов<br>";
            }
             if (!empty($password)) {
                $i_4 = $data_check->check_length($password, 6, 50);
                if ($i_4 == false) $i_4_res = "- пароль менее 6 или более 50 символов";
                elseif ($password != $password_rep) $i_4_res = "- пароли не совпадают";
             }
             
             if (!empty($e_mail)) {
                $i_5 = $data_check->check_length($e_mail, 2, 30);
                if($i_5 == false) $i_5_res = "- e_mail менее 2 или более 30 символов";
            }

            //check login for presence in the database
            $query = "SELECT * FROM user_data WHERE login='$login'";
            $result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));
           
            $row = mysqli_fetch_row($result); // select one row
           
            if ($row != NULL) {
                echo "<a href='registration.php?f_name=$fst_name&s_name=$sec_name&login=$login&e_mail=$e_mail'><---Назад</a><br>";
                exit ("Ошибка! Такой логин уже существует!");
            }
             
             $result = $i_1_res . $i_2_res . $i_3_res . $i_4_res . $i_5_res;
             return $result;
        }

       

        public function data_transfer() {

            $database = new ConnectionToDatabase();
            $link = $database->connection();
            
             $data_check = $this->data_check; // property class (data_check)

            // protection against XSS attack and SQL injection
            $login = $data_check->data_Protection($link, $_POST['login']);
            $e_mail = $data_check->data_Protection($link, $_POST['e_mail']);
            $password = $data_check->data_Protection($link, $_POST['password']);
            $first_name = $data_check->data_Protection($link, $_POST['first_name']);
            $second_name = $data_check->data_Protection($link, $_POST['second_name']);

            // hashing password
            $password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO user_data VALUES(NULL, '$login', '$e_mail', '$password', NULL, '$first_name', '$second_name', NULL, NULL, NULL, NULL)";

            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

            mysqli_close($link);

            return $result;
        }        
    }

    // class for validation data
    class DataCheck {

        public function clean($name) {
            $result = $name;
            $result = trim($result); // delete spaces from strat and end line
            $result = stripslashes($result); // delete display symbols
            $result = strip_tags($result); // delete HTML and PHP tags
            $result = htmlspecialchars($result); // transform special symbols in HTML-essence

            return $result;
        }

         public function check_length($value, $min, $max) {

            $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);

            return !$result;
        }

        public function data_Protection($link, $var_protect) {
            
              $value = htmlentities(mysqli_real_escape_string($link, $var_protect));
              
              return $value;
        }

    }

    class Records {

        public function add() {

            $database = new ConnectionToDatabase();
            $link = $database->connection();

            if (isset($_GET['id_upd'])) return; // if update record - not add new record 
            if (empty($_POST['title'])) exit ("Ошибка! Не введен Загловок");

            $data_check = new DataCheck();

            // checking 'title'
            $clean_title = $data_check->clean($_POST['title']);
            $title_protect = $data_check->data_Protection($link, $clean_title);

            // checking 'main_text'
            $clean_main_text = $data_check->clean($_POST['main_text']);
            $main_text_protect = $data_check->data_Protection($link, $clean_main_text);

            $ses = $_SESSION['login'];
            $query = "INSERT INTO records VALUES(NULL, '$title_protect', '$main_text_protect', NOW(), '$ses')";
            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

            if ($result) echo "Успешно! Запись добавлена!<br>";
           
            mysqli_close($link);

        }

        public function selectData() {

            $database = new ConnectionToDatabase();
            $link = $database->connection();

            $login = $_SESSION['login'];
            $query = "SELECT * FROM records where user='$login'";
            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
           
            if($result) {

                $rows = mysqli_num_rows($result); // number rows on the table

                echo "<table class='table_rec'><tr class='table_tr'><th>Заголовок</th><th>Текст</th><th>Дата</th><th></th></tr>";
                for ($i = 0; $i < $rows; $i++) {
                    $row = mysqli_fetch_row($result); // select one row
                    echo "<tr>";
                        for ($j = 1; $j < 4; $j++)
                            echo "<td>$row[$j]</td>";
                    echo "<td>
                            <a href='records.php?id_del=$row[0]'>Удалить</a>
                            <a href='update_rec.php?id_upd=$row[0]'>Изменить</a>
                            </td></tr>";
                }
                echo "</table>";

                mysqli_free_result($result); // clean result

            }

            mysqli_close($link);

        }

        public function deleteData() {

            if (isset($_GET['id_del'])) {

                $database = new ConnectionToDatabase();
                $link = $database->connection();

                $id = $_GET['id_del'];
                $query = "DELETE FROM records WHERE id_rec='$id'";
                $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

                if ($result) echo "Успешно! Запись изменена";

            }            

        }

        public function updateData() {

            if (isset($_GET['id_upd'])) {

                $database = new ConnectionToDatabase();
                $link = $database->connection();

                $id = $_REQUEST['id_upd'];
                $title = $_REQUEST['title'];
                $main_text = $_REQUEST['main_text'];

                $query = "UPDATE records SET title='$title', main_text='$main_text' WHERE id_rec='$id'";
                $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

                if ($result) echo "Успешно! Запись изменена";

            }         

        }

        public function selectRecord($id) {

                $database = new ConnectionToDatabase();
                $link = $database->connection();

                $query = "SELECT * FROM records where id_rec='$id'";
                $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

                $row = mysqli_fetch_row($result);

                return $row;
        }

    }

?>
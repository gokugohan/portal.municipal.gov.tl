<?php

add_action('wp_ajax_add_new_coursera_user', 'add_new_coursera_user');
add_action('wp_ajax_nopriv_add_new_coursera_user', 'add_new_coursera_user');


function add_new_coursera_user()
{

    global $wpdb;
    global $current_user;
    wp_get_current_user();

    $table_name = $wpdb->prefix . "coursera_users";


    $password = esc_attr($_POST['password']);
    $firstName = esc_attr($_POST['firstname']);
    $lastName = esc_attr($_POST['lastname']);
    $email = esc_attr($_POST['email']);
    $eppn = esc_attr($_POST['eppn']);

//    $salt = uniqid('cousera');
//    $passwordHash = hash('sha256', $salt . $password);
    $data = array(
        "uid" => uniqid(),
//        "password" => $passwordHash,
        "firstName" => ($firstName),
        "lastName" => ($lastName),
        "email" => ($email),
        "eduPersonPrincipalName" => ($eppn),
        "created_by" => $current_user->user_login
    );


    $query = "INSERT INTO $table_name(uid,firstName,lastName,email,password,eduPersonPrincipalName,created_by) values(
     '" . uniqid() . "',
    '" . $firstName . "',
    '" . $lastName . "',
    '" . $email . "',
    AES_ENCRYPT('" .$password. "', 'portalmunicipal-sso-simplesamlphp2022'),
    '" . $eppn . "',
    '" . $current_user->user_login . "'
    )";


    var_dump($query);
    $results = $wpdb->get_results($query);

    var_dump($results);

//    $wpdb->insert($table_name, $data);
    die();
}//add_new_coursera_user


add_action('wp_ajax_update_coursera_user', 'update_coursera_user');
add_action('wp_ajax_nopriv_update_coursera_user', 'update_coursera_user');

function update_coursera_user()
{
    global $wpdb;
    global $current_user;
    wp_get_current_user();
    $table_name = $wpdb->prefix . "coursera_users";


    $id = esc_attr($_POST['id']);
    $firstName = esc_attr($_POST['firstname']);
    $lastName = esc_attr($_POST['lastname']);
    $email = esc_attr($_POST['email']);
    $data = array(
        "firstName" => ($firstName),
        "lastName" => ($lastName),
        "email" => ($email),
        "updated_by" => $current_user->user_login
    );

    $wpdb->update($table_name, $data, array("uid" => $id));
    die();
}//update_coursera_user

add_action('wp_ajax_change_password_coursera_user', 'change_password_coursera_user');
add_action('wp_ajax_nopriv_change_password_coursera_user', 'change_password_coursera_user');

function change_password_coursera_user()
{
    global $wpdb;
    global $current_user;
    wp_get_current_user();
    $table_name = $wpdb->prefix . "coursera_users";


    $id = esc_attr($_POST['id']);
    $newpassowrd = esc_attr($_POST['newpassword']);

    $salt = uniqid('cousera');
    $passwordHash = hash('sha256', $salt . $newpassowrd);

    $data = array(
        "salt" => $salt,
        "password" => $passwordHash,
        "updated_by" => $current_user->user_login
    );

    $wpdb->update($table_name, $data, array("uid" => $id));
    die();
}//update_coursera_user


add_action('wp_ajax_delete_coursera_user', 'delete_coursera_user');
add_action('wp_ajax_nopriv_delete_coursera_user', 'delete_coursera_user');

function delete_coursera_user()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "coursera_users";
    var_dump($_POST);
    $wpdb->delete($table_name, array("uid" => $_POST['id']));
    die();
}//delete_coursera_user


add_action('wp_ajax_get_coursera_users', 'get_coursera_users');
add_action('wp_ajax_nopriv_get_coursera_users', 'get_coursera_users');

function get_coursera_users()
{

    global $wpdb;
    $table_name = $wpdb->prefix . "coursera_users";
    $results = $wpdb->get_results("SELECT uid,firstName,lastName, email,eduPersonPrincipalName as eppn, created_by, created_at, updated_by FROM $table_name ORDER BY firstName DESC");

    $html_table = '';
    if ($results) {
        foreach ($results

                 as $value) {
            $html_table .= '<tr><td>' . $value->firstName . ' ' . $value->lastName . '</td><td>' . $value->email . '</td>
<td>' . $value->eppn . '</td>
<td>
    <ul class="list-inline m-0">
        <li class="list-inline-item">
            <button class="btn btn-primary btn-sm rounded-0 btn-change-coursera-user-password"
                    type="button" data-toggle="tooltip"
                    data-id=" ' . $value->uid . '"
                    data-title="' . $value->firstName . ' ' . $value->lastName . '"
                    data-placement="top" title="Change Password"><i class="fa fa-key"></i></button>
        </li>
        <li class="list-inline-item">
            <button class="btn btn-success btn-sm rounded-0 btn-edit-coursera-user" type="button"
                    data-toggle="tooltip"
                    data-placement="top"
                    data-id="' . $value->uid . '"
                    data-firstName="' . $value->firstName . '"
                    data-lastName="' . $value->lastName . '"
                    data-email="' . $value->email . '"
                    title="Edit"><i class="fa fa-edit"></i></button>
        </li>
        <li class="list-inline-item">
            <button class="btn btn-danger btn-sm rounded-0 btn-delete-coursera-user" type="button"
                    data-id="' . $value->uid . '"
                    data-title="' . $value->firstName . ' ' . $value->lastName . '"
                    data-toggle="tooltip" data-placement="top" title="Delete"><i
                        class="fa fa-trash"></i></button>
        </li>
    </ul>

</td>
</tr>';

        }
    } else {
        $html_table = '<tr><td colspan="4">No users</td></tr>';
    }

    echo $html_table;
    die();
}//get_coursera_users

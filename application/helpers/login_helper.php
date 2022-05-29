<?php
    function is_logged_in(){

        $ci = get_instance(); //memanggil library CI untuk penggnti this krna helper ga mengenal this
        if(!$ci->session->userdata('email')){ 
            redirect('auth');
        }
        // else{
        //     $role_id = $ci->session->user('role_id');
        //     $menu = $ci->uri->segment(1);

        //     $queryMenu = $ci->db->get_where('user_menu', ['menu'=> $menu])->row_array();
        //     $menu_id = $queryMenu['menu_id'];

        //     $userAcess = $ci->db->get_where('user_access_menu', [
        //         'role_id' => $role_id,
        //         'menu_id' => $menu_id
        //     ]);
        // } -> klo uda ada lbih dari 1 page nantinya
    }
?>
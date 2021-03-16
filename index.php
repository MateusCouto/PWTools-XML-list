<?php

error_reporting(E_ALL); 

require_once("bd.php");
require_once("lista.php");




$xml = $pdo->query("select roleid,userid,name from users_shadow WHERE roleid >='1024'");
while ($arrc = $xml->fetch(PDO::FETCH_ASSOC)) {


    $id_conta = $arrc["userid"];
    $id_char = $arrc["roleid"];
    $nick = $arrc["name"];


    $xmlDDR = "bk_original\old_." . $id_char . ".xml";

    if (file_exists($xmlDDR)) {

        $xmlCommand = simplexml_load_file($xmlDDR);

        foreach ($ids as $id) {

            //find target node for removal with XPath
            $targets = $xmlCommand->xpath("//role/pocket/items/variable[@name='id'][text()='$id']/..");

            if (count($targets) > 0) {

                $qtde1 = count($targets);
                $sql_inv = "INSERT INTO history_list(id_conta,id_char,nick,id_item,categoria,qtde) 
			VALUES ('$id_conta','$id_char','$nick','$id','Inventário','$qtde1')";

                $pdo->query($sql_inv);
            }
        }

        foreach ($ids as $id) {

            //find target node for removal with XPath
            $targets = $xmlCommand->xpath("//role/equipment/inv/variable[@name='id'][text()='$id']/..");



            // check if the id is not found.
            if (count($targets) > 0) {

                $qtde2 = count($targets);
                $sql_equip = "INSERT INTO history_list(id_conta,id_char,nick,id_item,categoria,qtde) VALUES ('$id_conta','$id_char','$nick','$id','Equipamento','$qtde2')";

                $pdo->query($sql_equip);
            }
        }
        // Terceira Opção
        foreach ($ids as $id) {

            //find target node for removal with XPath
            $targets = $xmlCommand->xpath("//role/storehouse/items/variable[@name='id'][text()='$id']/..");



            // check if the id is not found.
            if (count($targets) > 0) {

                $qtde3 = count($targets);
                $sql_inv = "INSERT INTO history_list(id_conta,id_char,nick,id_item,categoria,qtde) 
			VALUES ('$id_conta','$id_char','$nick','$id','Banqueiro','$qtde3')";

                $pdo->query($sql_inv);
            }
        }
    }
}

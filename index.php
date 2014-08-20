<?php 
$menu_content = "";
$sub1menu_content = "";
$sub1tas = "";
$type_of_assessment = "";
function main()
{
    GLOBAL $menu_content, $sub1menu_content, $type_of_assessment, $sub1tas, $_GET;

    if (isset($_GET['type_of_assessment'])) {
        $type_of_assessment = (int)$_GET['type_of_assessment'];
        if ($type_of_assessment < 1  || $type_of_assessment > 4) {
            $type_of_assessment = 1;
        }
    }
    else { 
        $type_of_assessment = 1;
    }

    if (isset($_GET['sub1tas'])) {
        $sub1tas = (int)$_GET['sub1tas'];
        if ($sub1tas < 1  || $sub1tas > 2) {
            $sub1tas = 1;
        }
    }
    else { 
        $sub1tas = 1;
    }

    $desc = array('Structural System', 'Label2', 'Label3', 'Label4');
    for ($i = 0 ; $i < count($desc) ; $i++) {
        if ($i + 1 == $type_of_assessment) {
            $menu_content .= sprintf('<li id="menu_id-%d" class="vuln_menu_selected" onclick="menu_set(this);">%s</li>', $i+1, $desc[$i]);
        }
        else {
            $menu_content .= sprintf('<li id="menu_id-%d" class="vuln_menu" onclick="menu_set(this);">%s</li>', $i+1, $desc[$i]);
        }
    }


    $sub1desc = array('Direction X', 'Direction Y');
    for ($i = 0 ; $i < count($sub1desc) ; $i++) {
        if ($i + 1 == $sub1tas) {
            $sub1menu_content .= sprintf('<li id="sub1menu_id-%d" class="vuln_menu_selected" onclick="sub1menu_set(this);">%s</li>', $i+1, $sub1desc[$i]);
        }
        else {
            $sub1menu_content .= sprintf('<li id="sub1menu_id-%d" class="vuln_menu" onclick="sub1menu_set(this);">%s</li>', $i+1, $sub1desc[$i]);
        }
    }
}

main();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
<title>TaxT</title>

<style>
ul.vuln_menu
{
    width:100%;
    padding: 7px 0px 7px 0px;
    margin:0;
    list-style-type:none;
    /*    background-image: url('/static/img/OQ_header_bg.png'); */
    background-position: left bottom;
    border-bottom: 1px solid #1b75a7;
}

li.vuln_menu {
    display:inline;
    color: black;
    margin: 0px;
    padding: 8px;
    cursor: pointer; 
}

li.vuln_menu_selected {
    display:inline;
    color: black;
    background-color: #ffffff;
    margin: 0px;
    padding: 8px;
    border: 1px solid #1b75a7;
    border-bottom: 1px solid white;
    cursor: pointer; 
}

a.vuln_menu
{
    width:6em;
    color: #1b75a7;
    padding:0.2em 0.6em;
}

a.vuln_menu:hover {
    text-decoration:underline;
}
</style>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript"><!--
function menu_set(id_or_obj) {
    var menu_items;
    var submenu_cur = 1;

    console.log("xx" + typeof(id_or_obj));
    if (typeof(id_or_obj) == 'object') {
        id = id_or_obj.id;
    }
    else if (typeof(id_or_obj) == 'number') { 
        id = "menu_id-" + id_or_obj;
        console.log("QUI: "+id+ " "+arguments.length);
        if (arguments.length > 1) {
        console.log("QUA: "+arguments[1]);
            submenu_cur = arguments[1];
        }
    }
    console.log("yy" + id);

    menu_items = $('[id|="menu_id"]');
        console.log("zz" + menu_items);
    
    
    for (i = 0 ; i < menu_items.length ; i++) {
        console.log("zz" + menu_items[i].id);
        if (menu_items[i].id == id) {
            
            $(menu_items[i]).removeClass("vuln_menu");
            $(menu_items[i]).addClass("vuln_menu_selected");
            // FIXME
            $("#main_content-"+(i+1)).css('display', '');
        }
        else {
            $(menu_items[i]).removeClass("vuln_menu_selected");
            $(menu_items[i]).addClass("vuln_menu");
            $("#main_content-"+(i+1)).css('display', 'none');
        }
    }
    if (typeof(id_or_obj) == 'number' && id == "menu_id-1") {
        sub1menu_set(submenu_cur);
    }
}

function sub1menu_set(id_or_obj) {
    var menu_items;

    console.log("xx " + typeof(id_or_obj));
    if (typeof(id_or_obj) == 'object') {
        id = id_or_obj.id;
    }
    else if (typeof(id_or_obj) == 'number') { 
        id = "sub1menu_id-" + id_or_obj;
    }
    console.log("yy " + id);

    menu_items = $('[id|="sub1menu_id"]');
        console.log("zz " + menu_items);
    
    
    for (i = 0 ; i < menu_items.length ; i++) {
        console.log("zz" + menu_items[i].id);
        if (menu_items[i].id == id) {
            
            $(menu_items[i]).removeClass("vuln_menu");
            $(menu_items[i]).addClass("vuln_menu_selected");
            // FIXME
            console.log("WW "+"sub1_content-"+(i+1));
            $("#sub1_content-"+(i+1)).css('display', '');
        }
        else {
            console.log("ww "+"sub1_content-"+(i+1));
            $(menu_items[i]).removeClass("vuln_menu_selected");
            $(menu_items[i]).addClass("vuln_menu");
            $("#sub1_content-"+(i+1)).css('display', 'none');
        }
    }
}

function sub1_dir_set(obj) {
    if (obj.name == "sub1_xdir") {
        $("#sub1_ydir_"+obj.value).prop("checked", true);
    }
    else if (obj.name == "sub1_ydir") {
        $("#sub1_xdir_"+obj.value).prop("checked", true);
    }

    return true;
}


window.onload = function () {
    var menu_cur = <?php echo $type_of_assessment; ?>;
    var sub1menu_cur = <?php echo $sub1tas; ?>;
    menu_set(menu_cur, sub1menu_cur);
}
//-->
</script>
</head>

<body>
<ul class="vuln_menu">
    <?php echo "$menu_content"; ?>
</ul>
    <div id="main_content_parent" style="position: relative; width: 800px; height: 650px; background-color: #ccccff; /* blue */">
        <div id="main_content-1" style="position: absolute; display: none; top: 0px; width: 800px; height: 500px; background-color: #ffcccc; /*red */">
            <ul class="vuln_menu">
                <?php echo "$sub1menu_content"; ?>
            </ul>

            <div id="sub1_content-1" style="position: absolute; display: none; top: 50px; width: 700px; height: 400px; background-color: #c0c0c0;">
                <dir style="border:1px solid gray; margin: 4px;">
                    <h4>Direction specification:</h4>
                    <table style="width: 100%; margin: 8px;"><tr>
                        <td><input type="radio" id="sub1_xdir_unspec" name="sub1_xdir" checked value="unspec" onclick="sub1_dir_set(this);">Unspecified direction</td>
                        <td><input type="radio" id="sub1_xdir_spec" name="sub1_xdir" value="spec" onclick="sub1_dir_set(this);">Parallel to street</td>
                    </tr></table>
            </div>
            <div id="sub1_content-2" style="position: absolute; display: none; top: 50px; width: 700px; height: 400px; background-color: #a0a0a0;">

                <dir style="border:1px solid gray; margin: 4px;">
                    <h4>Direction specification:</h4>
                    <table style="width: 100%; margin: 8px;"><tr>
                        <td><input type="radio" id="sub1_ydir_unspec" name="sub1_ydir" checked value="unspec" onclick="sub1_dir_set(this);">Unspecified direction</td>
                        <td><input type="radio" id="sub1_ydir_spec" name="sub1_ydir" value="spec" onclick="sub1_dir_set(this);">Perpendicular to street</td>
                    </tr></table>
                </div>
            </div>

            <div id="main_content-2" style="position: absolute; display: none; top: 0px; width: 800px; height: 500px; background-color: #ccffcc; /* green */">
green
            </div>
            <div id="main_content-3" style="position: absolute; display: none; top: 0px; width: 800px; height: 500px; background-color: #ffe6cc; /* orange */">
orange
            </div>
            <div id="main_content-4" style="position: absolute; display: none; top: 0px; width: 800px; height: 500px; background-color: #ffccff; /*violet*/">
violet
            </div>
            <div style="position: absolute; bottom: 0px; margin: 8px;" >
                <p>Taxonomy string for this building typology: </p>
                <p><input id="taxonomy" type="text"></input></p>
                <p><input id="omit_unkown" type="checkbox">Omit code if corresponding parameter in unknown</p>
           </div>
      </div>
</div>
<h1></h1>



<hr>
<address></address>
<!-- hhmts start -->Last modified: Tue Aug 19 15:43:13 CEST 2014 <!-- hhmts end -->
</body> </html>

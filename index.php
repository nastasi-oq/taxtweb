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

a.vuln_menu {
    width:6em;
    color: #1b75a7;
    padding:0.2em 0.6em;
}

a.vuln_menu:hover {
    text-decoration:underline;
}

table.dir_spec {
    margin: auto;
    width: 90%;
}

table.dir_spec td {
    text-align: center;
    width: 50%;
}
</style>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript"><!--

function select_populate(name, items)
{
    console.log("dentro");
    for (var i = 0 ; i < items.length ; i++) {
        item = items[i];

        console.log("yuhu");
        $('#'+name).append('<option value="'+i+'">'+item+'</option>');
    }
}

function taxt_ValidateSystem1()
{
    $('#SystemCB21').empty();

    if ($('#SystemCB11').val() == 0 || $('#SystemCB11').val() == 1) {
        $('SystemCB21').prop("disabled", true);
    }
    else {
        var SystemCB21 = [];
        SystemCB21.push('Ductility unknown');
        SystemCB21.push('Ductile');
        SystemCB21.push('Non-ductile');
        SystemCB21.push('Base isolation and/or energy dissipation devices');
        select_populate('SystemCB21', SystemCB21);
        $('SystemCB21').prop("disabled", false);
    }
    $('SystemCB21').val(0);
}

function taxt_ValidateSystem2()
{
    $('#SystemCB22').empty();

    if ($('#SystemCB12').val() == 0 || $('#SystemCB12').val() == 1) {
        $('SystemCB22').prop("disabled", true);
    }
    else {
        var SystemCB22 = [];
        SystemCB22.push('Ductility unknown');
        SystemCB22.push('Ductile');
        SystemCB22.push('Non-ductile');
        SystemCB22.push('Base isolation and/or energy dissipation devices');
        select_populate('SystemCB22', SystemCB22);
        $('SystemCB22').prop("disabled", false);
    }
    $('SystemCB22').val(0);
}

function taxt_ValidateMaterial1()
{
    $('#MaterialCB21').empty();
    $('#MaterialCB31').empty();
    $('#MaterialCB41').empty();
    $('#SystemCB11').empty();


    if ($('#MaterialCB11').val() == 0) {
        $('#MaterialCB21').prop("disabled", true);
        $('#MaterialCB31').prop("disabled", true);
        $('#MaterialCB41').prop("disabled", true);
    }
    else if ($('#MaterialCB11').val() == 2) {
        var MaterialCB21 = [];
        MaterialCB21.push('Unknown concrete technology');
        MaterialCB21.push('Cast-in-place concrete');
        MaterialCB21.push('Precast concrete');
        select_populate('MaterialCB21', MaterialCB21);
        $('#MaterialCB21').prop("disabled", false);
    }
    else if ($('#MaterialCB11').val() == 1 ||  $('#MaterialCB11').val() == 3 || $('#MaterialCB11').val() == 4) {
        var MaterialCB21 = [];
        MaterialCB21.push('Unknown concrete technology');
        MaterialCB21.push('Cast-in-place concrete');
        MaterialCB21.push('Precast concrete');
        MaterialCB21.push('Cast-in-place prestressed concrete');
        MaterialCB21.push('Precast prestressed concrete');
        select_populate('MaterialCB21', MaterialCB21);
        $('#MaterialCB21').prop("disabled", false);
    }
    else if ($('#MaterialCB11').val() == 5) {
        var MaterialCB21 = [];
        MaterialCB21.push('Steel, unknown ');
        MaterialCB21.push('Cold-formed steel members');
        MaterialCB21.push('Hot-rolled steel members');
        MaterialCB21.push('Steel, other ');
        select_populate('MaterialCB21', MaterialCB21);
        $('#MaterialCB21').prop("disabled", false);
    }
    else if ($('#MaterialCB11').val() == 6) {
        var MaterialCB21 = [];
        MaterialCB21.push('Metal, unknown ');
        MaterialCB21.push('Iron');
        MaterialCB21.push('Metal, other ');
        select_populate('MaterialCB21', MaterialCB21);
        $('#MaterialCB21').prop("disabled", false);
    }
    else if ($('#MaterialCB11').val() > 6 &&
             $('#MaterialCB11').val() < 11) {
        var MaterialCB21 = [];
        MaterialCB21.push('Masonry unit, unknown');
        MaterialCB21.push('Adobe blocks');
        MaterialCB21.push('Stone, unknown technology');
        MaterialCB21.push('Rubble (field stone) or semi-dressed stone');
        MaterialCB21.push('Dressed stone');
        MaterialCB21.push('Fired clay unit, unknown type');
        MaterialCB21.push('Fired clay solid bricks');
        MaterialCB21.push('Fired clay hollow bricks');
        MaterialCB21.push('Fired clay hollow blocks or tiles');
        MaterialCB21.push('Concrete blocks, unknown type');
        MaterialCB21.push('Concrete blocks, solid');
        MaterialCB21.push('Concrete blocks, hollow');
        MaterialCB21.push('Masonry unit, other');
        select_populate('MaterialCB21', MaterialCB21);
        $('#MaterialCB21').prop("disabled", false);

        if ($('#MaterialCB11').val() == 10) {
            var MaterialCB41 = [];
            MaterialCB41.push('Unknown reinforcement');
            MaterialCB41.push('Steel-reinforced');
            MaterialCB41.push('Wood-reinforced');
            MaterialCB41.push('Bamboo-, cane- or rope-reinforced');
            MaterialCB41.push('Fibre reinforcing mesh');
            MaterialCB41.push('Reinforced concrete bands');
            select_populate('MaterialCB41', MaterialCB41);
            $('#MaterialCB41').prop("disabled", false);
        }
    }
    else if ($('#MaterialCB11').val() > 10 && $('#MaterialCB11').val() < 14) {
        var MaterialCB21 = [];
        MaterialCB21.push('Unknown earth technology');
        MaterialCB21.push('Rammed earth');
        MaterialCB21.push('Cob or wet construction');
        MaterialCB21.push('Earth technology, other');
        select_populate('MaterialCB21', MaterialCB21);
        $('#MaterialCB21').prop("disabled", false);
    }
    else if ($('#MaterialCB11').val() == 14) {
        var MaterialCB21 = [];
        MaterialCB21.push('Wood, unknown');
        MaterialCB21.push('Heavy wood');
        MaterialCB21.push('Light wood members');
        MaterialCB21.push('Solid wood');
        MaterialCB21.push('Wattle and daub');
        MaterialCB21.push('Bamboo');
        MaterialCB21.push('Wood, other');
        select_populate('MaterialCB21', MaterialCB21);
        $('#MaterialCB21').prop("disabled", false);
    }
    else {
        $('#MaterialCB21').prop("disabled", true);
        $('#MaterialCB31').prop("disabled", true);
        $('#MaterialCB41').prop("disabled", true);
    }

    if ($('#MaterialCB11').val() == 5) {
        var MaterialCB31 = [];
        MaterialCB31.push('Unknown connection');
        MaterialCB31.push('Welded connections');
        MaterialCB31.push('Riveted connections');
        MaterialCB31.push('Bolted connections');
        select_populate('MaterialCB31', MaterialCB31);
        $('#MaterialCB31').prop("disabled", false);
    }
    else if ($('#MaterialCB11').val() > 6 &&
             $('#MaterialCB11').val() < 11) {
        var MaterialCB31 = [];
        MaterialCB31.push('Mortar type, unknown');
        MaterialCB31.push('No mortar');
        MaterialCB31.push('Mud mortar');
        MaterialCB31.push('Lime mortar');
        MaterialCB31.push('Cement mortar');
        MaterialCB31.push('Cement:lime mortar');
        MaterialCB31.push('Stone, unknown type');
        MaterialCB31.push('Limestone');
        MaterialCB31.push('Sandstone');
        MaterialCB31.push('Tuff');
        MaterialCB31.push('Slate');
        MaterialCB31.push('Granite');
        MaterialCB31.push('Basalt');
        MaterialCB31.push('Stone, other type');
        select_populate('MaterialCB31', MaterialCB31);
        $('#MaterialCB31').prop("disabled", false);
    }
    else {
        $('#MaterialCB31').prop("disabled", true);
    }

    $('#MaterialCB21').val(0);
    $('#MaterialCB31').val(0);
    $('#MaterialCB41').val(0);

    if ($('#MaterialCB11').val() > 10 && $('#MaterialCB11').val() < 14) {
        var SystemCB11 = [];
        SystemCB11.push('Unknown lateral load-resisting system');
        SystemCB11.push('No lateral load-resisting system');
        SystemCB11.push('Wall');
        SystemCB11.push('Hybrid lateral load-resisting system');
        SystemCB11.push('Other lateral load-resisting system');
        select_populate('SystemCB11', SystemCB11);
    }
    else if (($('#MaterialCB11').val() > 6 && $('#MaterialCB11').val() < 11) ||
             $('#MaterialCB11').val() == 14) {
        var SystemCB11 = [];
        SystemCB11.push('Unknown lateral load-resisting system');
        SystemCB11.push('No lateral load-resisting system');
        SystemCB11.push('Moment frame');
        SystemCB11.push('Post and beam');
        SystemCB11.push('Wall');
        SystemCB11.push('Hybrid lateral load-resisting system');
        SystemCB11.push('Other lateral load-resisting system');
        select_populate('SystemCB11', SystemCB11);
    }
    else {
        var SystemCB11 = [];
        SystemCB11.push('Unknown lateral load-resisting system');
        SystemCB11.push('No lateral load-resisting system');
        SystemCB11.push('Moment frame');
        SystemCB11.push('Infilled frame');
        SystemCB11.push('Braced frame');
        SystemCB11.push('Post and beam');
        SystemCB11.push('Wall');
        SystemCB11.push('Dual frame-wall system');
        SystemCB11.push('Flat slab/plate or waffle slab');
        SystemCB11.push('Infilled flat slab/plate or infilled waffle slab');
        SystemCB11.push('Hybrid lateral load-resisting system');
        SystemCB11.push('Other lateral load-resisting system');
        select_populate('SystemCB11', SystemCB11);
    }

    $('#SystemCB11').val(0);
    taxt_ValidateSystem1();
}

function taxt_ValidateMaterial2()
{
    $('#MaterialCB22').empty();
    $('#MaterialCB32').empty();
    $('#MaterialCB42').empty();
    $('#SystemCB12').empty();


    if ($('#MaterialCB12').val() == 0) {
        $('#MaterialCB22').prop("disabled", true);
        $('#MaterialCB32').prop("disabled", true);
        $('#MaterialCB42').prop("disabled", true);
    }
    else if ($('#MaterialCB12').val() == 2) {
        var MaterialCB22 = [];
        MaterialCB22.push('Unknown concrete technology');
        MaterialCB22.push('Cast-in-place concrete');
        MaterialCB22.push('Precast concrete');
        select_populate('MaterialCB22', MaterialCB22);
        $('#MaterialCB22').prop("disabled", false);
    }
    else if ($('#MaterialCB12').val() == 1 ||  $('#MaterialCB12').val() == 3 || $('#MaterialCB12').val() == 4) {
        var MaterialCB22 = [];
        MaterialCB22.push('Unknown concrete technology');
        MaterialCB22.push('Cast-in-place concrete');
        MaterialCB22.push('Precast concrete');
        MaterialCB22.push('Cast-in-place prestressed concrete');
        MaterialCB22.push('Precast prestressed concrete');
        select_populate('MaterialCB22', MaterialCB22);
        $('#MaterialCB22').prop("disabled", false);
    }
    else if ($('#MaterialCB12').val() == 5) {
        var MaterialCB22 = [];
        MaterialCB22.push('Steel, unknown ');
        MaterialCB22.push('Cold-formed steel members');
        MaterialCB22.push('Hot-rolled steel members');
        MaterialCB22.push('Steel, other ');
        select_populate('MaterialCB22', MaterialCB22);
        $('#MaterialCB22').prop("disabled", false);
    }
    else if ($('#MaterialCB12').val() == 6) {
        var MaterialCB22 = [];
        MaterialCB22.push('Metal, unknown ');
        MaterialCB22.push('Iron');
        MaterialCB22.push('Metal, other ');
        select_populate('MaterialCB22', MaterialCB22);
        $('#MaterialCB22').prop("disabled", false);
    }
    else if ($('#MaterialCB12').val() > 6 &&
             $('#MaterialCB12').val() < 11) {
        var MaterialCB22 = [];
        MaterialCB22.push('Masonry unit, unknown');
        MaterialCB22.push('Adobe blocks');
        MaterialCB22.push('Stone, unknown technology');
        MaterialCB22.push('Rubble (field stone) or semi-dressed stone');
        MaterialCB22.push('Dressed stone');
        MaterialCB22.push('Fired clay unit, unknown type');
        MaterialCB22.push('Fired clay solid bricks');
        MaterialCB22.push('Fired clay hollow bricks');
        MaterialCB22.push('Fired clay hollow blocks or tiles');
        MaterialCB22.push('Concrete blocks, unknown type');
        MaterialCB22.push('Concrete blocks, solid');
        MaterialCB22.push('Concrete blocks, hollow');
        MaterialCB22.push('Masonry unit, other');
        select_populate('MaterialCB22', MaterialCB22);
        $('#MaterialCB22').prop("disabled", false);

        if ($('#MaterialCB12').val() == 10) {
            var MaterialCB42 = [];
            MaterialCB42.push('Unknown reinforcement');
            MaterialCB42.push('Steel-reinforced');
            MaterialCB42.push('Wood-reinforced');
            MaterialCB42.push('Bamboo-, cane- or rope-reinforced');
            MaterialCB42.push('Fibre reinforcing mesh');
            MaterialCB42.push('Reinforced concrete bands');
            select_populate('MaterialCB42', MaterialCB42);
            $('#MaterialCB42').prop("disabled", false);
        }
    }
    else if ($('#MaterialCB12').val() > 10 && $('#MaterialCB12').val() < 14) {
        var MaterialCB22 = [];
        MaterialCB22.push('Unknown earth technology');
        MaterialCB22.push('Rammed earth');
        MaterialCB22.push('Cob or wet construction');
        MaterialCB22.push('Earth technology, other');
        select_populate('MaterialCB22', MaterialCB22);
        $('#MaterialCB22').prop("disabled", false);
    }
    else if ($('#MaterialCB12').val() == 14) {
        var MaterialCB22 = [];
        MaterialCB22.push('Wood, unknown');
        MaterialCB22.push('Heavy wood');
        MaterialCB22.push('Light wood members');
        MaterialCB22.push('Solid wood');
        MaterialCB22.push('Wattle and daub');
        MaterialCB22.push('Bamboo');
        MaterialCB22.push('Wood, other');
        select_populate('MaterialCB22', MaterialCB22);
        $('#MaterialCB22').prop("disabled", false);
    }
    else {
        $('#MaterialCB22').prop("disabled", true);
        $('#MaterialCB32').prop("disabled", true);
        $('#MaterialCB42').prop("disabled", true);
    }

    if ($('#MaterialCB12').val() == 5) {
        var MaterialCB32 = [];
        MaterialCB32.push('Unknown connection');
        MaterialCB32.push('Welded connections');
        MaterialCB32.push('Riveted connections');
        MaterialCB32.push('Bolted connections');
        select_populate('MaterialCB32', MaterialCB32);
        $('#MaterialCB32').prop("disabled", false);
    }
    else if ($('#MaterialCB12').val() > 6 &&
             $('#MaterialCB12').val() < 11) {
        var MaterialCB32 = [];
        MaterialCB32.push('Mortar type, unknown');
        MaterialCB32.push('No mortar');
        MaterialCB32.push('Mud mortar');
        MaterialCB32.push('Lime mortar');
        MaterialCB32.push('Cement mortar');
        MaterialCB32.push('Cement:lime mortar');
        MaterialCB32.push('Stone, unknown type');
        MaterialCB32.push('Limestone');
        MaterialCB32.push('Sandstone');
        MaterialCB32.push('Tuff');
        MaterialCB32.push('Slate');
        MaterialCB32.push('Granite');
        MaterialCB32.push('Basalt');
        MaterialCB32.push('Stone, other type');
        select_populate('MaterialCB32', MaterialCB32);
        $('#MaterialCB32').prop("disabled", false);
    }
    else {
        $('#MaterialCB32').prop("disabled", true);
    }

    $('#MaterialCB22').val(0);
    $('#MaterialCB32').val(0);
    $('#MaterialCB42').val(0);

    if ($('#MaterialCB12').val() > 10 && $('#MaterialCB12').val() < 14) {
        var SystemCB12 = [];
        SystemCB12.push('Unknown lateral load-resisting system');
        SystemCB12.push('No lateral load-resisting system');
        SystemCB12.push('Wall');
        SystemCB12.push('Hybrid lateral load-resisting system');
        SystemCB12.push('Other lateral load-resisting system');
        select_populate('SystemCB12', SystemCB12);
    }
    else if (($('#MaterialCB12').val() > 6 && $('#MaterialCB12').val() < 11) ||
             $('#MaterialCB12').val() == 14) {
        var SystemCB12 = [];
        SystemCB12.push('Unknown lateral load-resisting system');
        SystemCB12.push('No lateral load-resisting system');
        SystemCB12.push('Moment frame');
        SystemCB12.push('Post and beam');
        SystemCB12.push('Wall');
        SystemCB12.push('Hybrid lateral load-resisting system');
        SystemCB12.push('Other lateral load-resisting system');
        select_populate('SystemCB12', SystemCB12);
    }
    else {
        var SystemCB12 = [];
        SystemCB12.push('Unknown lateral load-resisting system');
        SystemCB12.push('No lateral load-resisting system');
        SystemCB12.push('Moment frame');
        SystemCB12.push('Infilled frame');
        SystemCB12.push('Braced frame');
        SystemCB12.push('Post and beam');
        SystemCB12.push('Wall');
        SystemCB12.push('Dual frame-wall system');
        SystemCB12.push('Flat slab/plate or waffle slab');
        SystemCB12.push('Infilled flat slab/plate or infilled waffle slab');
        SystemCB12.push('Hybrid lateral load-resisting system');
        SystemCB12.push('Other lateral load-resisting system');
        select_populate('SystemCB12', SystemCB12);
    }

    $('#SystemCB12').val(0);
    taxt_ValidateSystem2();
}

function taxt_SetDirection2()
{
    if ($('#DirectionCB').prop('checked')) {
        $('#MaterialCB12').val($('#MaterialCB11').val());
        $('#MaterialCB22').val($('#MaterialCB21').val());
        $('#MaterialCB32').val($('#MaterialCB31').val());
        $('#MaterialCB42').val($('#MaterialCB41').val());
        $('#SystemCB12').val($('#SystemCB11').val());
        $('#SystemCB22').val($('#SystemCB21').val());
    }
}

function taxt_MaterialCB11Select(obj)
{
    taxt_ValidateMaterial1();
    taxt_SetDirection2();
    if ($('#DirectionCB').prop('checked')) {
        taxt_ValidateMaterial2();
    }
    taxt_BuildTaxonomy();
}

function taxt_MaterialCB12Select(obj)
{
    taxt_ValidateMaterial2();
    taxt_ValidateSystem2();
    taxt_BuildTaxonomy();
}

function taxt_BuildTaxonomy()
{
    console.log("taxt_BuildTaxonomy TODO");
}


function taxt_Initiate() {

    $('#DirectionCB').prop('checked', true);

    // FIXME: t0 only, load a preview saved taxonomy must be done
    var MaterialCB11 = [], MaterialCB12 = [];


    MaterialCB11.push('Unknown Material');
    MaterialCB11.push('Concrete, unknown reinforcement');
    MaterialCB11.push('Concrete, unreinforced');
    MaterialCB11.push('Concrete, reinforced');
    MaterialCB11.push('Concrete, composite with steel section');
    MaterialCB11.push('Steel');
    MaterialCB11.push('Metal (except steel)');
    MaterialCB11.push('Masonry, unknown reinforcement');
    MaterialCB11.push('Masonry, unreinforced');
    MaterialCB11.push('Masonry, confined');
    MaterialCB11.push('Masonry, reinforced');
    MaterialCB11.push('Earth, unknown reinforcement');
    MaterialCB11.push('Earth, unreinforced');
    MaterialCB11.push('Earth, reinforced');
    MaterialCB11.push('Wood');
    MaterialCB11.push('Other material');
    select_populate('MaterialCB11', MaterialCB11);
    $('#MaterialCB11').on('change', taxt_MaterialCB11Select);

    MaterialCB12.push('Unknown Material');
    MaterialCB12.push('Concrete, unknown reinforcement');
    MaterialCB12.push('Concrete, unreinforced');
    MaterialCB12.push('Concrete, reinforced');
    MaterialCB12.push('Concrete, composite with steel section');
    MaterialCB12.push('Steel');
    MaterialCB12.push('Metal (except steel)');
    MaterialCB12.push('Masonry, unknown reinforcement');
    MaterialCB12.push('Masonry, unreinforced');
    MaterialCB12.push('Masonry, confined');
    MaterialCB12.push('Masonry, reinforced');
    MaterialCB12.push('Earth, unknown reinforcement');
    MaterialCB12.push('Earth, unreinforced');
    MaterialCB12.push('Earth, reinforced');
    MaterialCB12.push('Wood');
    MaterialCB12.push('Other material');
    select_populate('MaterialCB12', MaterialCB12);


}

function menu_set(id_or_obj) {
    var menu_items;
    var submenu_cur = 1;

    console.log("xx" + typeof(id_or_obj));
    if (typeof(id_or_obj) == 'object') {
        id = id_or_obj.id;
    }
    else if (typeof(id_or_obj) == 'number') {
        taxt_Initiate();

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
            console.log("ZZZZ " + menu_items[i].id + " ID:" + id);
            $(menu_items[i]).removeClass("vuln_menu");
            $(menu_items[i]).addClass("vuln_menu_selected");
            $("#main_content-"+(i+1)).css('display', '');
        }
        else {
            console.log("zzzz " + menu_items[i].id + " ID:" + id);
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
        if (menu_items[i].id == id) {
            $(menu_items[i]).removeClass("vuln_menu");
            $(menu_items[i]).addClass("vuln_menu_selected");
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
                <li class="vuln_menu"><input type="checkbox" id="DirectionCB">Use same parameters in both directions</li>
            </ul>

            <div id="sub1_content-1" style="position: absolute; display: none; top: 50px; width: 700px; height: 400px; background-color: #c0c0c0;">
                <div style="border:1px solid gray; margin: 4px;">
                    <h4>Direction specification:</h4>
                    <table class="dir_spec"><tr>
                        <td><input type="radio" id="sub1_xdir_unspec" name="sub1_xdir" checked value="unspec" onclick="sub1_dir_set(this);">Unspecified direction</td>
                        <td><input type="radio" id="sub1_xdir_spec" name="sub1_xdir" value="spec" onclick="sub1_dir_set(this);">Parallel to street</td>
                    </tr></table>
                </div>

                <div style="border:1px solid gray; margin: 4px;">
                    <h4>Material of lateral load-resisting system</h4>
                    <table class="dir_spec"><tr>
                        <td><div>Material type:<br>
                                 <select id="MaterialCB11"></select></div></td>
                        <td><div>Material technology:<br>
                                 <select id="MaterialCB21"></select></div></td>
                      </tr><tr>
                        <td><div>Material Properties:<br>
                                 <select id="MaterialCB31"></select></div></td>
                        <td><div>Material technology (additional):<br>
                                 <select  id="MaterialCB41"></select></div></td>
                    </tr></table>
                </div>

                <div style="border:1px solid gray; margin: 4px;">
                    <h4>Lateral load-resisting system</h4>
                    <table class="dir_spec"><tr>
                        <td><div>Type lateral load-resisting system:<br><select id="SystemCB11"></select></div></td>
                        <td><div>System ductility:<br><select id="SystemCB21"></select></div></td>
                    </tr></table>
                </div>

            </div>
            <div id="sub1_content-2" style="position: absolute; display: none; top: 50px; width: 700px; height: 400px; background-color: #a0a0a0;">

                <div style="border:1px solid gray; margin: 4px;">
                    <h4>Direction specification:</h4>
                    <table class="dir_spec"><tr>
                        <td><input type="radio" id="sub1_ydir_unspec" name="sub1_ydir" checked value="unspec" onclick="sub1_dir_set(this);">Unspecified direction</td>
                        <td><input type="radio" id="sub1_ydir_spec" name="sub1_ydir" value="spec" onclick="sub1_dir_set(this);">Perpendicular to street</td>
                    </tr></table>
                </div>

                <div style="border:1px solid gray; margin: 4px;">
                    <h4>Material of lateral load-resisting system</h4>
                    <table class="dir_spec"><tr>
                        <td><div>Material type:<br>
                                 <select id="MaterialCB12"></select></div></td>
                        <td><div>Material technology:<br>
                                 <select id="MaterialCB22"></select></div></td>
                      </tr><tr>
                        <td><div>Material Properties:<br>
                                 <select id="MaterialCB32"></select></div></td>
                        <td><div>Material technology (additional):<br>
                                 <select  id="MaterialCB42"></select></div></td>
                    </tr></table>
                </div>

                <div style="border:1px solid gray; margin: 4px;">
                    <h4>Lateral load-resisting system</h4>
                    <table class="dir_spec"><tr>
                        <td><div>Type lateral load-resisting system:<br><select id="SystemCB12"></select></div></td>
                        <td><div>System ductility:<br><select id="SystemCB22"></select></div></td>
                    </tr></table>
                </div>

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
            <p><input id="taxonomy" type="text" size="80" maxlength="120"></input></p>
            <p><input id="omit_unkown" type="checkbox">Omit code if corresponding parameter is unknown</p>
        </div>
    </div>
    <h1></h1>



<hr>
<address></address>
<!-- hhmts start -->Last modified: Tue Aug 19 15:43:13 CEST 2014 <!-- hhmts end -->
</body> </html>

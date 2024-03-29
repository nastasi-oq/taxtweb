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

    $desc = array('Structural System', 'Building Information', 'Label3', 'Label4');
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

function taxt_ValidateHeight()
{
    console.log("taxt_ValidateHeight FIXME");
    $('#HeightCB2').prop("disabled", true);
    $('#HeightCB3').prop("disabled", true);
    $('#HeightCB4').prop("disabled", true);
    $('#noStoreysE11').prop("disabled", true);
    $('#noStoreysE12').prop("disabled", true);
    $('#noStoreysE21').prop("disabled", true);
    $('#noStoreysE22').prop("disabled", true);
    $('#noStoreysE31').prop("disabled", true);
    $('#noStoreysE32').prop("disabled", true);
    $('#noStoreysE4').prop("disabled", true);

    if ($('#HeightCB1').val() > 0) {
        $('#HeightCB2').prop("disabled", false);
        $('#HeightCB3').prop("disabled", false);
        $('#HeightCB4').prop("disabled", false);
        $('#noStoreysE11').prop("disabled", false);
        $('#noStoreysE12').prop("disabled", false);

        if ($('#HeightCB1').val() == 1) {
            $('#noStoreysE11').css('width', '45%');
            $('#noStoreysE11').prop("disabled", false);
            $('#noStoreysE12').css('display', 'inline');
            $('#noStoreysE12').prop("disabled", false);
        }
        else {
            $('#noStoreysE11').css('width', '90%');
            $('#noStoreysE11').prop("disabled", false);
            $('#noStoreysE12').css('display', 'none');
            $('#noStoreysE12').prop("disabled", true);
        }

        if ($('#HeightCB2').val() == 0) {
            $('#noStoreysE21').css('width', '90%');
            $('#noStoreysE21').prop("disabled", true);
            $('#noStoreysE22').css('display', 'none');
            $('#noStoreysE22').prop("disabled", true);
        }
        else if ($('#HeightCB2').val() == 1) {
            $('#noStoreysE21').css('width', '45%');
            $('#noStoreysE21').prop("disabled", false);
            $('#noStoreysE22').css('display', 'inline');
            $('#noStoreysE22').prop("disabled", false);
        }
        else {
            $('#noStoreysE21').css('width', '90%');
            $('#noStoreysE21').prop("disabled", false);
            $('#noStoreysE22').css('display', 'none');
            $('#noStoreysE22').prop("disabled", true);
        }

        if ($('#HeightCB3').val() == 0) {
            $('#noStoreysE31').css('width', '90%');
            $('#noStoreysE31').prop("disabled", true);
            $('#noStoreysE32').css('display', 'none');
            $('#noStoreysE32').prop("disabled", true);
        }
        else if ($('#HeightCB3').val() == 1) {
            $('#noStoreysE31').css('width', '45%');
            $('#noStoreysE31').prop("disabled", false);
            $('#noStoreysE32').css('display', 'inline');
            $('#noStoreysE32').prop("disabled", false);
        }
        else {
            $('#noStoreysE31').css('width', '90%');
            $('#noStoreysE31').prop("disabled", false);
            $('#noStoreysE32').css('display', 'none');
            $('#noStoreysE32').prop("disabled", true);
        }

        if ($('#HeightCB4').val() == 0) {
            $('#noStoreysE4').prop("disabled", true);
        }
        else {
            $('#noStoreysE4').prop("disabled", false);
        }
    }
    else {
        $('#noStoreysE11').css('width', '90%');
        $('#noStoreysE11').prop("disabled", true);
        $('#noStoreysE12').css('display', 'none');
        $('#noStoreysE12').prop("disabled", true);
    }
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

function taxt_MaterialCB12Select(obj)
{
    taxt_ValidateMaterial2();
    taxt_ValidateSystem2();
    taxt_BuildTaxonomy();
}

function taxt_MaterialCB21Select(obj)
{
    taxt_SetDirection2();
    taxt_BuildTaxonomy();
}

function taxt_MaterialCB22Select(obj)
{
taxt_BuildTaxonomy();
}

function taxt_MaterialCB31Select(obj)
{
    taxt_SetDirection2();
    taxt_BuildTaxonomy();
}

function taxt_MaterialCB32Select(obj)
{
taxt_BuildTaxonomy();
}

function taxt_MaterialCB41Select(obj)
{
    taxt_SetDirection2();
    taxt_BuildTaxonomy();
}

function taxt_MaterialCB42Select(obj)
{
    taxt_BuildTaxonomy();
}

function taxt_SystemCB11Select(obj)
{
    taxt_SetDirection2();
    taxt_ValidateSystem1();
    if ($('#DirectionCB').prop('checked')) {
        taxt_ValidateSystem2();
    }
    taxt_BuildTaxonomy();
}

function taxt_SystemCB12Select(obj)
{
    taxt_ValidateSystem2();
    taxt_BuildTaxonomy();
}

function taxt_SystemCB21Select(obj)
{
    taxt_SetDirection2();
    taxt_BuildTaxonomy();
}

function taxt_SystemCB22Select(obj)
{
    taxt_BuildTaxonomy();
    /* FIXME ask probably question
    if SystemCB22.ItemIndex>0 then begin
                      reportForm.SystemCB22.Checked:= true;
    end
    else begin
             reportForm.MaterialCB22.Checked:= false;
    end;
    */
}

function taxt_HeightCB1Select(obj)
{
    taxt_ValidateHeight();
    taxt_BuildTaxonomy();
}

function taxt_HeightCB2Select(obj)
{
    taxt_ValidateHeight();
    taxt_BuildTaxonomy();
}

function taxt_HeightCB3Select(obj)
{
    taxt_ValidateHeight();
    taxt_BuildTaxonomy();
}

function taxt_HeightCB4Select(obj)
{
    taxt_ValidateHeight();
    taxt_BuildTaxonomy();
}


function taxt_Direction1RB1Click(obj)
{
    $("#Direction2RB1").prop("checked", true);
    taxt_BuildTaxonomy();
}
function taxt_Direction1RB2Click(obj)
{
    $("#Direction2RB3").prop("checked", true);
    taxt_BuildTaxonomy();
}
function taxt_Direction2RB1Click(obj)
{
    $("#Direction1RB1").prop("checked", true);
    taxt_BuildTaxonomy();
}
function taxt_Direction2RB3Click(obj)
{
    $("#Direction1RB2").prop("checked", true);
    taxt_BuildTaxonomy();
}

function taxt_OmitCBClick(obj)
{
    taxt_BuildTaxonomy();
}



function taxt_BuildTaxonomy()
{
    var Taxonomy = [], ResTax, direction1, direction2;

    for (var i = 0 ; i < 50 ; i++)
        Taxonomy[i] = "";
    /* Structural System: Direction X */

    if ( $('#MaterialCB11').val() == 0 && !$('#OmitCB').prop('checked') )
        Taxonomy[0] = 'MAT99';
    if ($('#MaterialCB11').val() == 1)
        Taxonomy[0] = 'C99';
    if ($('#MaterialCB11').val() == 2)
        Taxonomy[0] = 'CU';
    if ($('#MaterialCB11').val() == 3)
        Taxonomy[0] = 'CR';
    if ($('#MaterialCB11').val() == 4)
        Taxonomy[0] = 'SRC';

    if ( ($('#MaterialCB11').val() > 0) && ($('#MaterialCB11').val() < 5) ) {
        if ( ($('#MaterialCB21').val() == 0) && !$('#OmitCB').prop('checked') )
            Taxonomy[1] = '+CT99';
        if ($('#MaterialCB21').val() == 1)
            Taxonomy[1] = '+CIP';
        if ($('#MaterialCB21').val() == 2)
            Taxonomy[1] = '+PC';
        if ($('#MaterialCB21').val() == 3)
            Taxonomy[1] = '+CIPPS';
        if ($('#MaterialCB21').val() == 4)
            Taxonomy[1] = '+PCPS';
    }
    if ($('#MaterialCB11').val() == 5) {
        Taxonomy[0] = 'S';
        if ( $('#MaterialCB21').val() == 0 && !$('#OmitCB').prop('checked') )
            Taxonomy[1] = '+S99';
        if ( $('#MaterialCB21').val() == 1 )
            Taxonomy[1] = '+SL';
        if ( $('#MaterialCB21').val() == 2 )
            Taxonomy[1] = '+SR';
        if ( $('#MaterialCB21').val() == 3 )
            Taxonomy[1] = '+SO';
    }

    if ($('#MaterialCB11').val() == 6) {
        Taxonomy[0] = 'ME';
        if ( $('#MaterialCB21').val() == 0 && !$('#OmitCB').prop('checked') )
            Taxonomy[1] = '+ME99';
        if ($('#MaterialCB21').val() == 1)
            Taxonomy[1] = '+MEIR';
        if ($('#MaterialCB21').val() == 2)
            Taxonomy[1] = '+MEO';
    }

    if ($('#MaterialCB11').val() == 5) {
        if ( $('#MaterialCB31').val() == 0 && !$('#OmitCB').prop('checked') )
            Taxonomy[2] = '+SC99';
        if ($('#MaterialCB31').val() == 1)
            Taxonomy[2] = '+WEL';
        if ($('#MaterialCB31').val() == 2)
            Taxonomy[2] = '+RIV';
        if ($('#MaterialCB31').val() == 3)
            Taxonomy[2] = '+BOL';
    }

    if ($('#MaterialCB11').val() > 6 && $('#MaterialCB11').val() < 11) {
        if ($('#MaterialCB11').val() == 7)
            Taxonomy[0] = 'M99';
        if ($('#MaterialCB11').val() == 8)
            Taxonomy[0] = 'MUR';
        if ($('#MaterialCB11').val() == 9)
            Taxonomy[0] = 'MCF';

        if ( $('#MaterialCB21').val() == 0 && !$('#OmitCB').prop('checked') )
            Taxonomy[1] = '+MUN99';
        if ($('#MaterialCB21').val() == 1)
            Taxonomy[1] = '+ADO';
        if ($('#MaterialCB21').val() == 2)
            Taxonomy[1] = '+ST99';
        if ($('#MaterialCB21').val() == 3)
            Taxonomy[1] = '+STRUB';
        if ($('#MaterialCB21').val() == 4)
            Taxonomy[1] = '+STDRE';
        if ($('#MaterialCB21').val() == 5)
            Taxonomy[1] = '+CL99';
        if ($('#MaterialCB21').val() == 6)
            Taxonomy[1] = '+CLBRS';
        if ($('#MaterialCB21').val() == 7)
            Taxonomy[1] = '+CLBRH';
        if ($('#MaterialCB21').val() == 8)
            Taxonomy[1] = '+CLBLH';
        if ($('#MaterialCB21').val() == 9)
            Taxonomy[1] = '+CB99';
        if ($('#MaterialCB21').val() == 10)
            Taxonomy[1] = '+CBS';
        if ($('#MaterialCB21').val() == 11)
            Taxonomy[1] = '+CBH';
        if ($('#MaterialCB21').val() == 12)
            Taxonomy[1] = '+MO';

        if ($('#MaterialCB11').val() == 10) {
            Taxonomy[0] = 'MR';
            if ( ($('#MaterialCB41').val() == 0) && !$('#OmitCB').prop('checked') )
                Taxonomy[1] = Taxonomy[1]+'+MR99';
            if ($('#MaterialCB41').val() == 1)
                Taxonomy[1] = Taxonomy[1]+'+RS';
            if ($('#MaterialCB41').val() == 2)
                Taxonomy[1] = Taxonomy[1]+'+RW';
            if ($('#MaterialCB41').val() == 3)
                Taxonomy[1] = Taxonomy[1]+'+RB';
            if ($('#MaterialCB41').val() == 4)
                Taxonomy[1] = Taxonomy[1]+'+RCM';
            if ($('#MaterialCB41').val() == 5)
                Taxonomy[1] = Taxonomy[1]+'+RCB';
        }

        if (($('#MaterialCB31').val() == 0) && !$('#OmitCB').prop('checked') )
            Taxonomy[2] = '+MO99';
        if ($('#MaterialCB31').val() == 1)
            Taxonomy[2] = '+MON';
        if ($('#MaterialCB31').val() == 2)
            Taxonomy[2] = '+MOM';
        if ($('#MaterialCB31').val() == 3)
            Taxonomy[2] = '+MOL';
        if ($('#MaterialCB31').val() == 4)
            Taxonomy[2] = '+MOC';
        if ($('#MaterialCB31').val() == 5)
            Taxonomy[2] = '+MOCL';
        if ($('#MaterialCB31').val() == 6)
            Taxonomy[2] = '+SP99';
        if ($('#MaterialCB31').val() == 7)
            Taxonomy[2] = '+SPLI';
        if ($('#MaterialCB31').val() == 8)
            Taxonomy[2] = '+SPSA';
        if ($('#MaterialCB31').val() == 9)
            Taxonomy[2] = '+SPTU';
        if ($('#MaterialCB31').val() == 10)
            Taxonomy[2] = '+SPSL';
        if ($('#MaterialCB31').val() == 11)
            Taxonomy[2] = '+SPGR';
        if ($('#MaterialCB31').val() == 12)
            Taxonomy[2] = '+SPBA';
        if ($('#MaterialCB31').val() == 13)
            Taxonomy[2] = '+SPO';
    }

    if ( ($('#MaterialCB11').val()>10) && ($('#MaterialCB11').val()<14) ) {
        if ($('#MaterialCB11').val() == 11)
            Taxonomy[0] = 'E99';
        if ($('#MaterialCB11').val() == 12)
            Taxonomy[0] = 'EU';
        if ($('#MaterialCB11').val() == 13)
            Taxonomy[0] = 'ER';

        if ( ($('#MaterialCB21').val() == 0) && !$('#OmitCB').prop('checked') )
            Taxonomy[1] = '+ET99';
        if ($('#MaterialCB21').val() == 1)
            Taxonomy[1] = '+ETR';
        if ($('#MaterialCB21').val() == 2)
            Taxonomy[1] = '+ETC';
        if ($('#MaterialCB21').val() == 3)
            Taxonomy[1] = '+ETO';
    }

    if ($('#MaterialCB11').val() == 14) {
        Taxonomy[0] = 'W';
        if (($('#MaterialCB21').val() == 0) && !$('#OmitCB').prop('checked'))
            Taxonomy[1] = '+W99';
        if ($('#MaterialCB21').val() == 1)
            Taxonomy[1] = '+WHE';
        if ($('#MaterialCB21').val() == 2)
            Taxonomy[1] = '+WLI';
        if ($('#MaterialCB21').val() == 3)
            Taxonomy[1] = '+WS';
        if ($('#MaterialCB21').val() == 4)
            Taxonomy[1] = '+WWD';
        if ($('#MaterialCB21').val() == 5)
            Taxonomy[1] = '+WBB';
        if ($('#MaterialCB21').val() == 6)
            Taxonomy[1] = '+WO';
    }

    if ($('#MaterialCB11').val() == 15)
        Taxonomy[0] = 'MATO';

    if (($('#SystemCB11').val() == 0) && !$('#OmitCB').prop('checked'))
        Taxonomy[3] = 'L99';

    if ( ($('#MaterialCB11').val()>10) && ($('#MaterialCB11').val()<14) ) {
        if ($('#SystemCB11').val() == 1)
            Taxonomy[3] = 'LN';
        if ($('#SystemCB11').val() == 2)
            Taxonomy[3] = 'LWAL';
        if ($('#SystemCB11').val() == 3)
            Taxonomy[3] = 'LO';
    }
    else if ( (($('#MaterialCB11').val()>6) && ($('#MaterialCB11').val()<11)) || ($('#MaterialCB11').val() == 14)) {
        if ($('#SystemCB11').val() == 1)
            Taxonomy[3] = 'LN';
        if ($('#SystemCB11').val() == 2)
            Taxonomy[3] = 'LFM';;
        if ($('#SystemCB11').val() == 3)
            Taxonomy[3] = 'LPB';
        if ($('#SystemCB11').val() == 4)
            Taxonomy[3] = 'LWAL';
        if ($('#SystemCB11').val() == 5)
            Taxonomy[3] = 'LO';
    }
    else {
        if ($('#SystemCB11').val() == 1)
            Taxonomy[3] = 'LN';
        if ($('#SystemCB11').val() == 2)
            Taxonomy[3] = 'LFM';
        if ($('#SystemCB11').val() == 3)
            Taxonomy[3] = 'LFINF';
        if ($('#SystemCB11').val() == 4)
            Taxonomy[3] = 'LFBR';
        if ($('#SystemCB11').val() == 5)
            Taxonomy[3] = 'LPB';
        if ($('#SystemCB11').val() == 6)
            Taxonomy[3] = 'LWAL';
        if ($('#SystemCB11').val() == 7)
            Taxonomy[3] = 'LDUAL';
        if ($('#SystemCB11').val() == 8)
            Taxonomy[3] = 'LFLS';
        if ($('#SystemCB11').val() == 9)
            Taxonomy[3] = 'LFLSINF';
        if ($('#SystemCB11').val() == 10)
            Taxonomy[3] = 'LH';
        if ($('#SystemCB11').val() == 11)
            Taxonomy[3] = 'LO';
    }

    if ($('#SystemCB11').val() > 0) {
        if (($('#SystemCB21').val() == 0) && !$('#OmitCB').prop('checked'))
            Taxonomy[4] = '+DU99';
        if ($('#SystemCB21').val() == 1)
            Taxonomy[4] = '+DUC';
        if ($('#SystemCB21').val() == 2)
            Taxonomy[4] = '+DNO';
        if ($('#SystemCB21').val() == 3)
            Taxonomy[4] = '+DBD';
    }




    /* Structural System: Direction Y */




    if ( $('#MaterialCB12').val() == 0 && !$('#OmitCB').prop('checked') )
        Taxonomy[5] = 'MAT99';
    if ($('#MaterialCB12').val() == 1)
        Taxonomy[5] = 'C99';
    if ($('#MaterialCB12').val() == 2)
        Taxonomy[5] = 'CU';
    if ($('#MaterialCB12').val() == 3)
        Taxonomy[5] = 'CR';
    if ($('#MaterialCB12').val() == 4)
        Taxonomy[5] = 'SRC';

    if ( ($('#MaterialCB12').val() > 0) && ($('#MaterialCB12').val() < 5) ) {
        if ( ($('#MaterialCB22').val() == 0) && !$('#OmitCB').prop('checked') )
            Taxonomy[6] = '+CT99';
        if ($('#MaterialCB22').val() == 1)
            Taxonomy[6] = '+CIP';
        if ($('#MaterialCB22').val() == 2)
            Taxonomy[6] = '+PC';
        if ($('#MaterialCB22').val() == 3)
            Taxonomy[6] = '+CIPPS';
        if ($('#MaterialCB22').val() == 4)
            Taxonomy[6] = '+PCPS';
    }
    if ($('#MaterialCB12').val() == 5) {
        Taxonomy[5] = 'S';
        if ( $('#MaterialCB22').val() == 0 && !$('#OmitCB').prop('checked') )
            Taxonomy[6] = '+S99';
        if ( $('#MaterialCB22').val() == 1 )
            Taxonomy[6] = '+SL';
        if ( $('#MaterialCB22').val() == 2 )
            Taxonomy[6] = '+SR';
        if ( $('#MaterialCB22').val() == 3 )
            Taxonomy[6] = '+SO';
    }

    if ($('#MaterialCB12').val() == 6) {
        Taxonomy[5] = 'ME';
        if ( $('#MaterialCB22').val() == 0 && !$('#OmitCB').prop('checked') )
            Taxonomy[6] = '+ME99';
        if ($('#MaterialCB22').val() == 1)
            Taxonomy[6] = '+MEIR';
        if ($('#MaterialCB22').val() == 2)
            Taxonomy[6] = '+MEO';
    }

    if ($('#MaterialCB12').val() == 5) {
        if ( $('#MaterialCB32').val() == 0 && !$('#OmitCB').prop('checked') )
            Taxonomy[7] = '+SC99';
        if ($('#MaterialCB32').val() == 1)
            Taxonomy[7] = '+WEL';
        if ($('#MaterialCB32').val() == 2)
            Taxonomy[7] = '+RIV';
        if ($('#MaterialCB32').val() == 3)
            Taxonomy[7] = '+BOL';
    }

    if ($('#MaterialCB12').val() > 6 && $('#MaterialCB12').val() < 11) {
        if ($('#MaterialCB12').val() == 7)
            Taxonomy[5] = 'M99';
        if ($('#MaterialCB12').val() == 8)
            Taxonomy[5] = 'MUR';
        if ($('#MaterialCB12').val() == 9)
            Taxonomy[5] = 'MCF';

        if ( $('#MaterialCB22').val() == 0 && !$('#OmitCB').prop('checked') )
            Taxonomy[6] = '+MUN99';
        if ($('#MaterialCB22').val() == 1)
            Taxonomy[6] = '+ADO';
        if ($('#MaterialCB22').val() == 2)
            Taxonomy[6] = '+ST99';
        if ($('#MaterialCB22').val() == 3)
            Taxonomy[6] = '+STRUB';
        if ($('#MaterialCB22').val() == 4)
            Taxonomy[6] = '+STDRE';
        if ($('#MaterialCB22').val() == 5)
            Taxonomy[6] = '+CL99';
        if ($('#MaterialCB22').val() == 6)
            Taxonomy[6] = '+CLBRS';
        if ($('#MaterialCB22').val() == 7)
            Taxonomy[6] = '+CLBRH';
        if ($('#MaterialCB22').val() == 8)
            Taxonomy[6] = '+CLBLH';
        if ($('#MaterialCB22').val() == 9)
            Taxonomy[6] = '+CB99';
        if ($('#MaterialCB22').val() == 10)
            Taxonomy[6] = '+CBS';
        if ($('#MaterialCB22').val() == 11)
            Taxonomy[6] = '+CBH';
        if ($('#MaterialCB22').val() == 12)
            Taxonomy[6] = '+MO';

        if ($('#MaterialCB12').val() == 10) {
            Taxonomy[5] = 'MR';
            if ( ($('#MaterialCB42').val() == 0) && !$('#OmitCB').prop('checked') )
                Taxonomy[6] = Taxonomy[6]+'+MR99';
            if ($('#MaterialCB42').val() == 1)
                Taxonomy[6] = Taxonomy[6]+'+RS';
            if ($('#MaterialCB42').val() == 2)
                Taxonomy[6] = Taxonomy[6]+'+RW';
            if ($('#MaterialCB42').val() == 3)
                Taxonomy[6] = Taxonomy[6]+'+RB';
            if ($('#MaterialCB42').val() == 4)
                Taxonomy[6] = Taxonomy[6]+'+RCM';
            if ($('#MaterialCB42').val() == 5)
                Taxonomy[6] = Taxonomy[6]+'+RCB';
        }

        if (($('#MaterialCB32').val() == 0) && !$('#OmitCB').prop('checked') )
            Taxonomy[7] = '+MO99';
        if ($('#MaterialCB32').val() == 1)
            Taxonomy[7] = '+MON';
        if ($('#MaterialCB32').val() == 2)
            Taxonomy[7] = '+MOM';
        if ($('#MaterialCB32').val() == 3)
            Taxonomy[7] = '+MOL';
        if ($('#MaterialCB32').val() == 4)
            Taxonomy[7] = '+MOC';
        if ($('#MaterialCB32').val() == 5)
            Taxonomy[7] = '+MOCL';
        if ($('#MaterialCB32').val() == 6)
            Taxonomy[7] = '+SP99';
        if ($('#MaterialCB32').val() == 7)
            Taxonomy[7] = '+SPLI';
        if ($('#MaterialCB32').val() == 8)
            Taxonomy[7] = '+SPSA';
        if ($('#MaterialCB32').val() == 9)
            Taxonomy[7] = '+SPTU';
        if ($('#MaterialCB32').val() == 10)
            Taxonomy[7] = '+SPSL';
        if ($('#MaterialCB32').val() == 11)
            Taxonomy[7] = '+SPGR';
        if ($('#MaterialCB32').val() == 12)
            Taxonomy[7] = '+SPBA';
        if ($('#MaterialCB32').val() == 13)
            Taxonomy[7] = '+SPO';
    }

    if ( ($('#MaterialCB12').val()>10) && ($('#MaterialCB12').val()<14) ) {
        if ($('#MaterialCB12').val() == 11)
            Taxonomy[5] = 'E99';
        if ($('#MaterialCB12').val() == 12)
            Taxonomy[5] = 'EU';
        if ($('#MaterialCB12').val() == 13)
            Taxonomy[5] = 'ER';

        if ( ($('#MaterialCB22').val() == 0) && !$('#OmitCB').prop('checked') )
            Taxonomy[6] = '+ET99';
        if ($('#MaterialCB22').val() == 1)
            Taxonomy[6] = '+ETR';
        if ($('#MaterialCB22').val() == 2)
            Taxonomy[6] = '+ETC';
        if ($('#MaterialCB22').val() == 3)
            Taxonomy[6] = '+ETO';
    }

    if ($('#MaterialCB12').val() == 14) {
        Taxonomy[5] = 'W';
        if (($('#MaterialCB22').val() == 0) && !$('#OmitCB').prop('checked'))
            Taxonomy[6] = '+W99';
        if ($('#MaterialCB22').val() == 1)
            Taxonomy[6] = '+WHE';
        if ($('#MaterialCB22').val() == 2)
            Taxonomy[6] = '+WLI';
        if ($('#MaterialCB22').val() == 3)
            Taxonomy[6] = '+WS';
        if ($('#MaterialCB22').val() == 4)
            Taxonomy[6] = '+WWD';
        if ($('#MaterialCB22').val() == 5)
            Taxonomy[6] = '+WBB';
        if ($('#MaterialCB22').val() == 6)
            Taxonomy[6] = '+WO';
    }

    if ($('#MaterialCB12').val() == 15)
        Taxonomy[5] = 'MATO';

    if (($('#SystemCB12').val() == 0) && !$('#OmitCB').prop('checked'))
        Taxonomy[8] = 'L99';

    if ( ($('#MaterialCB12').val()>10) && ($('#MaterialCB12').val()<14) ) {
        if ($('#SystemCB12').val() == 1)
            Taxonomy[8] = 'LN';
        if ($('#SystemCB12').val() == 2)
            Taxonomy[8] = 'LWAL';
        if ($('#SystemCB12').val() == 3)
            Taxonomy[8] = 'LO';
    }
    else if ( (($('#MaterialCB12').val()>6) && ($('#MaterialCB12').val()<11)) || ($('#MaterialCB12').val() == 14)) {
        if ($('#SystemCB12').val() == 1)
            Taxonomy[8] = 'LN';
        if ($('#SystemCB12').val() == 2)
            Taxonomy[8] = 'LFM';;
        if ($('#SystemCB12').val() == 3)
            Taxonomy[8] = 'LPB';
        if ($('#SystemCB12').val() == 4)
            Taxonomy[8] = 'LWAL';
        if ($('#SystemCB12').val() == 5)
            Taxonomy[8] = 'LO';
    }
    else {
        if ($('#SystemCB12').val() == 1)
            Taxonomy[8] = 'LN';
        if ($('#SystemCB12').val() == 2)
            Taxonomy[8] = 'LFM';
        if ($('#SystemCB12').val() == 3)
            Taxonomy[8] = 'LFINF';
        if ($('#SystemCB12').val() == 4)
            Taxonomy[8] = 'LFBR';
        if ($('#SystemCB12').val() == 5)
            Taxonomy[8] = 'LPB';
        if ($('#SystemCB12').val() == 6)
            Taxonomy[8] = 'LWAL';
        if ($('#SystemCB12').val() == 7)
            Taxonomy[8] = 'LDUAL';
        if ($('#SystemCB12').val() == 8)
            Taxonomy[8] = 'LFLS';
        if ($('#SystemCB12').val() == 9)
            Taxonomy[8] = 'LFLSINF';
        if ($('#SystemCB12').val() == 10)
            Taxonomy[8] = 'LH';
        if ($('#SystemCB12').val() == 11)
            Taxonomy[8] = 'LO';
    }

    if ($('#SystemCB12').val() > 0) {
        if (($('#SystemCB22').val() == 0) && !$('#OmitCB').prop('checked'))
            Taxonomy[9] = '+DU99';
        if ($('#SystemCB22').val() == 1)
            Taxonomy[9] = '+DUC';
        if ($('#SystemCB22').val() == 2)
            Taxonomy[9] = '+DNO';
        if ($('#SystemCB22').val() == 3)
            Taxonomy[9] = '+DBD';
    }


    /*
 if (DateCB1.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[10]:='Y99';
  if DateCB1.ItemIndex=1 then Taxonomy[10]:='YEX:'+dateE1.Text;
  if DateCB1.ItemIndex=2 then Taxonomy[10]:='YBET:'+dateE1.Text+','+dateE2.Text;
  if DateCB1.ItemIndex=3 then Taxonomy[10]:='YPRE:'+dateE1.Text;
  if DateCB1.ItemIndex=4 then Taxonomy[10]:='YAPP:'+dateE1.Text;
    */
    // MOP HEIGHT DONE
    if ($('#HeightCB1').val() == 0) {
        if (!$('#OmitCB').prop('checked'))
            Taxonomy[11] ='H99';
    }
    else {
        if ($('#HeightCB1').val() == 1)
            Taxonomy[11] = 'HBET:'+$('#noStoreysE11').val()+','+$('#noStoreysE12').val();
        if ($('#HeightCB1').val() == 2)
            Taxonomy[11] = 'HEX:'+$('#noStoreysE11').val();
        if ($('#HeightCB1').val() == 3)
            Taxonomy[11] = 'HAPP:'+$('#noStoreysE11').val();

        if ($('#HeightCB2').val() == 0 && !$('#OmitCB').prop('checked'))
            Taxonomy[12] = '+HB99';
        if ($('#HeightCB2').val() == 1)
            Taxonomy[12] = '+HBBET:'+$('#noStoreysE21').val()+','+$('#noStoreysE22').val();
        if ($('#HeightCB2').val() == 2)
            Taxonomy[12] = '+HBEX:'+$('#noStoreysE21').val();
        if ($('#HeightCB2').val() == 3)
            Taxonomy[12] = '+HBAPP:'+$('#noStoreysE21').val();

        if ($('#HeightCB3').val() == 0 && !$('#OmitCB').prop('checked'))
            Taxonomy[12] = '+HF99';
        if ($('#HeightCB3').val() == 1)
            Taxonomy[13] = '+HFBET:'+$('#noStoreysE31').val()+',' + $('#noStoreysE32').val();
        if ($('#HeightCB3').val() == 2)
            Taxonomy[13] = '+HFEX:'+$('#noStoreysE31').val();
        if ($('#HeightCB3').val() == 3)
            Taxonomy[13] = '+HFAPP:'+$('#noStoreysE31').val();

        if ($('#HeightCB4').val() == 0 && !$('#OmitCB').prop('checked'))
            Taxonomy[14] = '+HD99';
        if ($('#HeightCB4').val() == 1)
            Taxonomy[14] = '+HD:' + $('#noStoreysE4').val();
    }

    // TAIL
    direction1 = 'DX';
    direction2 = 'DY';

    if ($('#Direction1RB1').prop('checked')  && !$('#OmitCB').prop('checked')) {
        direction1 = direction1 + '+D99';
        direction2 = direction2 + '+D99';
        }
    else if ($('#Direction1RB2').prop('checked')) {
        direction1 = direction1+'+PF';
        direction2 = direction2+'+OF';
    }

    ResTax = direction1+'/'+Taxonomy[0]+Taxonomy[1]+Taxonomy[2]+'/'+Taxonomy[3]+Taxonomy[4]+'/'+direction2+'/'+Taxonomy[5]+Taxonomy[6]+Taxonomy[7]+'/'+Taxonomy[8]+Taxonomy[9]+'/'
        +Taxonomy[11]+Taxonomy[12]+Taxonomy[13]+Taxonomy[14]+'/'+Taxonomy[10]+'/'+Taxonomy[15]+Taxonomy[16]+'/'+Taxonomy[17]+'/'+Taxonomy[18]+'/'+Taxonomy[19]+Taxonomy[20]
        +Taxonomy[22]+Taxonomy[21]+Taxonomy[23]+'/'+Taxonomy[24]+'/'+Taxonomy[25]+Taxonomy[26]+Taxonomy[27]+Taxonomy[28]+Taxonomy[29]+'/'+Taxonomy[30]
        +Taxonomy[31]+Taxonomy[32]+'/'+Taxonomy[33];
    $('#resultE').val(ResTax);
}




/*
procedure TmainForm.BuildTaxonomy;
var
  Taxonomy: array [0..33] of string;
  ResTax, direction1, direction2: string;
begin

  //0 - Material type D1
  //1 - Material technology D1
  //2 - Material properties D1
  //3 - Type of lateral system D1
  //4 - System ductility D1
  //5 - Material type D2
  //6 - Material technology D2
  //7 - Material properties D2
  //8 - Type of lateral system D2
  //9 - System ductility D2
  //10- Date of construction
  //11- Height above the ground
  //12- Height below the ground
  //13- Height of grade
  //14- Slope of the ground
  //15- Occupancy type
  //16- Occupancy description
  //17- Position
  //18- Plan
  //19- Type of irregularity
  //20- Plan irregularity(primary)
  //21- Plan irregularity(secondary)
  //22- Vertical irregularity(primary)
  //23- Vertical irregularity(secondary)
  //24- Material of exterior walls
  //25- Roof shape
  //26- Roof covering
  //27- Roof system material
  //28- Roof system type
  //29- Roof connections
  //30- Floor system material
  //31- Floor system type
  //32- Floor connections
  //33 - Foundation

  if (MaterialCB11.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[0]:='MAT99';
  if MaterialCB11.ItemIndex=1 then Taxonomy[0]:='C99';
  if MaterialCB11.ItemIndex=2 then Taxonomy[0]:='CU';
  if MaterialCB11.ItemIndex=3 then Taxonomy[0]:='CR';
  if MaterialCB11.ItemIndex=4 then Taxonomy[0]:='SRC';

  if (MaterialCB11.ItemIndex>0) and (MaterialCB11.ItemIndex<5)  then begin
    if (MaterialCB21.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[1]:='+CT99';
    if MaterialCB21.ItemIndex=1 then Taxonomy[1]:='+CIP';
    if MaterialCB21.ItemIndex=2 then Taxonomy[1]:='+PC';
    if MaterialCB21.ItemIndex=3 then Taxonomy[1]:='+CIPPS';
    if MaterialCB21.ItemIndex=4 then Taxonomy[1]:='+PCPS';
  end;

  if MaterialCB11.ItemIndex=5 then begin
    Taxonomy[0]:='S';
    if (MaterialCB21.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[1]:='+S99';
    if MaterialCB21.ItemIndex=1 then Taxonomy[1]:='+SL';
    if MaterialCB21.ItemIndex=2 then Taxonomy[1]:='+SR';
    if MaterialCB21.ItemIndex=3 then Taxonomy[1]:='+SO';
  end;

  if MaterialCB11.ItemIndex=6 then begin
    Taxonomy[0]:='ME';
    if (MaterialCB21.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[1]:='+ME99';
    if MaterialCB21.ItemIndex=1 then Taxonomy[1]:='+MEIR';
    if MaterialCB21.ItemIndex=2 then Taxonomy[1]:='+MEO';
  end;

  if MaterialCB11.ItemIndex=5 then begin
    if (MaterialCB31.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[2]:='+SC99';
    if MaterialCB31.ItemIndex=1 then Taxonomy[2]:='+WEL';
    if MaterialCB31.ItemIndex=2 then Taxonomy[2]:='+RIV';
    if MaterialCB31.ItemIndex=3 then Taxonomy[2]:='+BOL';
  end;

  if (MaterialCB11.ItemIndex>6) and (MaterialCB11.ItemIndex<11) then begin
    if MaterialCB11.ItemIndex=7 then Taxonomy[0]:='M99';
    if MaterialCB11.ItemIndex=8 then Taxonomy[0]:='MUR';
    if MaterialCB11.ItemIndex=9 then Taxonomy[0]:='MCF';

    if (MaterialCB21.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[1]:='+MUN99';
    if MaterialCB21.ItemIndex=1 then Taxonomy[1]:='+ADO';
    if MaterialCB21.ItemIndex=2 then Taxonomy[1]:='+ST99';
    if MaterialCB21.ItemIndex=3 then Taxonomy[1]:='+STRUB';
    if MaterialCB21.ItemIndex=4 then Taxonomy[1]:='+STDRE';
    if MaterialCB21.ItemIndex=5 then Taxonomy[1]:='+CL99';
    if MaterialCB21.ItemIndex=6 then Taxonomy[1]:='+CLBRS';
    if MaterialCB21.ItemIndex=7 then Taxonomy[1]:='+CLBRH';
    if MaterialCB21.ItemIndex=8 then Taxonomy[1]:='+CLBLH';
    if MaterialCB21.ItemIndex=9 then Taxonomy[1]:='+CB99';
    if MaterialCB21.ItemIndex=10 then Taxonomy[1]:='+CBS';
    if MaterialCB21.ItemIndex=11 then Taxonomy[1]:='+CBH';
    if MaterialCB21.ItemIndex=12 then Taxonomy[1]:='+MO';

    if MaterialCB11.ItemIndex=10 then begin
      Taxonomy[0]:='MR';
      if (MaterialCB41.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[1]:=Taxonomy[1]+'+MR99';
      if MaterialCB41.ItemIndex=1 then Taxonomy[1]:=Taxonomy[1]+'+RS';
      if MaterialCB41.ItemIndex=2 then Taxonomy[1]:=Taxonomy[1]+'+RW';
      if MaterialCB41.ItemIndex=3 then Taxonomy[1]:=Taxonomy[1]+'+RB';
      if MaterialCB41.ItemIndex=4 then Taxonomy[1]:=Taxonomy[1]+'+RCM';
      if MaterialCB41.ItemIndex=5 then Taxonomy[1]:=Taxonomy[1]+'+RCB';
    end;

    if (MaterialCB31.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[2]:='+MO99';
    if MaterialCB31.ItemIndex=1 then Taxonomy[2]:='+MON';
    if MaterialCB31.ItemIndex=2 then Taxonomy[2]:='+MOM';
    if MaterialCB31.ItemIndex=3 then Taxonomy[2]:='+MOL';
    if MaterialCB31.ItemIndex=4 then Taxonomy[2]:='+MOC';
    if MaterialCB31.ItemIndex=5 then Taxonomy[2]:='+MOCL';
    if MaterialCB31.ItemIndex=6 then Taxonomy[2]:='+SP99';
    if MaterialCB31.ItemIndex=7 then Taxonomy[2]:='+SPLI';
    if MaterialCB31.ItemIndex=8 then Taxonomy[2]:='+SPSA';
    if MaterialCB31.ItemIndex=9 then Taxonomy[2]:='+SPTU';
    if MaterialCB31.ItemIndex=10 then Taxonomy[2]:='+SPSL';
    if MaterialCB31.ItemIndex=11 then Taxonomy[2]:='+SPGR';
    if MaterialCB31.ItemIndex=12 then Taxonomy[2]:='+SPBA';
    if MaterialCB31.ItemIndex=13 then Taxonomy[2]:='+SPO';

  end;

  if (MaterialCB11.ItemIndex>10) and (MaterialCB11.ItemIndex<14) then begin
    if MaterialCB11.ItemIndex=11 then Taxonomy[0]:='E99';
    if MaterialCB11.ItemIndex=12 then Taxonomy[0]:='EU';
    if MaterialCB11.ItemIndex=13 then Taxonomy[0]:='ER';

    if (MaterialCB21.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[1]:='+ET99';
    if MaterialCB21.ItemIndex=1 then Taxonomy[1]:='+ETR';
    if MaterialCB21.ItemIndex=2 then Taxonomy[1]:='+ETC';
    if MaterialCB21.ItemIndex=3 then Taxonomy[1]:='+ETO';
  end;

  if MaterialCB11.ItemIndex=14 then begin
    Taxonomy[0]:='W';
    if (MaterialCB21.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[1]:='+W99';
    if MaterialCB21.ItemIndex=1 then Taxonomy[1]:='+WHE';
    if MaterialCB21.ItemIndex=2 then Taxonomy[1]:='+WLI';
    if MaterialCB21.ItemIndex=3 then Taxonomy[1]:='+WS';
    if MaterialCB21.ItemIndex=4 then Taxonomy[1]:='+WWD';
    if MaterialCB21.ItemIndex=5 then Taxonomy[1]:='+WBB';
    if MaterialCB21.ItemIndex=6 then Taxonomy[1]:='+WO';
  end;

  if MaterialCB11.ItemIndex=15 then Taxonomy[0]:='MATO';

  if (SystemCB11.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[3]:='L99';

  if (MaterialCB11.ItemIndex>10) and (MaterialCB11.ItemIndex<14) then begin
    if SystemCB11.ItemIndex=1 then Taxonomy[3]:='LN';
    if SystemCB11.ItemIndex=2 then Taxonomy[3]:='LWAL';
    if SystemCB11.ItemIndex=3 then Taxonomy[3]:='LO';
  end
  else if ((MaterialCB11.ItemIndex>6) and (MaterialCB11.ItemIndex<11)) or (MaterialCB11.ItemIndex=14) then begin
    if SystemCB11.ItemIndex=1 then Taxonomy[3]:='LN';
    if SystemCB11.ItemIndex=2 then Taxonomy[3]:='LFM';;
    if SystemCB11.ItemIndex=3 then Taxonomy[3]:='LPB';
    if SystemCB11.ItemIndex=4 then Taxonomy[3]:='LWAL';
    if SystemCB11.ItemIndex=5 then Taxonomy[3]:='LO';
  end
  else begin
    if SystemCB11.ItemIndex=1 then Taxonomy[3]:='LN';
    if SystemCB11.ItemIndex=2 then Taxonomy[3]:='LFM';
    if SystemCB11.ItemIndex=3 then Taxonomy[3]:='LFINF';
    if SystemCB11.ItemIndex=4 then Taxonomy[3]:='LFBR';
    if SystemCB11.ItemIndex=5 then Taxonomy[3]:='LPB';
    if SystemCB11.ItemIndex=6 then Taxonomy[3]:='LWAL';
    if SystemCB11.ItemIndex=7 then Taxonomy[3]:='LDUAL';
    if SystemCB11.ItemIndex=8 then Taxonomy[3]:='LFLS';
    if SystemCB11.ItemIndex=9 then Taxonomy[3]:='LFLSINF';
    if SystemCB11.ItemIndex=10 then Taxonomy[3]:='LH';
    if SystemCB11.ItemIndex=11 then Taxonomy[3]:='LO';
  end;

  if SystemCB11.ItemIndex>0 then begin
    if (SystemCB21.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[4]:='+DU99';
    if SystemCB21.ItemIndex=1 then Taxonomy[4]:='+DUC';
    if SystemCB21.ItemIndex=2 then Taxonomy[4]:='+DNO';
    if SystemCB21.ItemIndex=3 then Taxonomy[4]:='+DBD';
  end;

  if (MaterialCB12.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[5]:='MAT99';
  if MaterialCB12.ItemIndex=1 then Taxonomy[5]:='C99';
  if MaterialCB12.ItemIndex=2 then Taxonomy[5]:='CU';
  if MaterialCB12.ItemIndex=3 then Taxonomy[5]:='CR';
  if MaterialCB12.ItemIndex=4 then Taxonomy[5]:='SRC';

  if (MaterialCB12.ItemIndex>0) and (MaterialCB12.ItemIndex<5)  then begin
    if (MaterialCB22.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[6]:='+CT99';
    if MaterialCB22.ItemIndex=1 then Taxonomy[6]:='+CIP';
    if MaterialCB22.ItemIndex=2 then Taxonomy[6]:='+PC';
    if MaterialCB22.ItemIndex=3 then Taxonomy[6]:='+CIPPS';
    if MaterialCB22.ItemIndex=4 then Taxonomy[6]:='+PCPS';
  end;



  if MaterialCB12.ItemIndex=5 then begin
    Taxonomy[5]:='S';
    if (MaterialCB22.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[6]:='+S99';
    if MaterialCB22.ItemIndex=1 then Taxonomy[6]:='+SL';
    if MaterialCB22.ItemIndex=2 then Taxonomy[6]:='+SR';
    if MaterialCB22.ItemIndex=3 then Taxonomy[6]:='+SO';
  end;

  if MaterialCB12.ItemIndex=6 then begin
    Taxonomy[5]:='ME';
    if (MaterialCB22.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[6]:='+ME99';
    if MaterialCB22.ItemIndex=1 then Taxonomy[6]:='+MEIR';
    if MaterialCB22.ItemIndex=2 then Taxonomy[6]:='+MEO';
  end;

  if MaterialCB12.ItemIndex=5 then begin
    if (MaterialCB32.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[7]:='+SC99';
    if MaterialCB32.ItemIndex=1 then Taxonomy[7]:='+WEL';
    if MaterialCB32.ItemIndex=2 then Taxonomy[7]:='+RIV';
    if MaterialCB32.ItemIndex=3 then Taxonomy[7]:='+BOL';
  end;

  if (MaterialCB12.ItemIndex>6) and (MaterialCB12.ItemIndex<11) then begin
    if MaterialCB12.ItemIndex=7 then Taxonomy[5]:='M99';
    if MaterialCB12.ItemIndex=8 then Taxonomy[5]:='MUR';
    if MaterialCB12.ItemIndex=9 then Taxonomy[5]:='MCF';

    if (MaterialCB22.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[6]:='+MUN99';
    if MaterialCB22.ItemIndex=1 then Taxonomy[6]:='+ADO';
    if MaterialCB22.ItemIndex=2 then Taxonomy[6]:='+ST99';
    if MaterialCB22.ItemIndex=3 then Taxonomy[6]:='+STRUB';
    if MaterialCB22.ItemIndex=4 then Taxonomy[6]:='+STDRE';
    if MaterialCB22.ItemIndex=5 then Taxonomy[6]:='+CL99';
    if MaterialCB22.ItemIndex=6 then Taxonomy[6]:='+CLBRS';
    if MaterialCB22.ItemIndex=7 then Taxonomy[6]:='+CLBRH';
    if MaterialCB22.ItemIndex=8 then Taxonomy[6]:='+CLBLH';
    if MaterialCB22.ItemIndex=9 then Taxonomy[6]:='+CB99';
    if MaterialCB22.ItemIndex=10 then Taxonomy[6]:='+CBS';
    if MaterialCB22.ItemIndex=11 then Taxonomy[6]:='+CBH';
    if MaterialCB22.ItemIndex=12 then Taxonomy[6]:='+MO';

    if MaterialCB12.ItemIndex=10 then begin
      Taxonomy[5]:='MR';
      if (MaterialCB42.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[6]:=Taxonomy[6]+'+MR99';
      if MaterialCB42.ItemIndex=1 then Taxonomy[6]:=Taxonomy[6]+'+RS';
      if MaterialCB42.ItemIndex=2 then Taxonomy[6]:=Taxonomy[6]+'+RW';
      if MaterialCB42.ItemIndex=3 then Taxonomy[6]:=Taxonomy[6]+'+RB';
      if MaterialCB42.ItemIndex=4 then Taxonomy[6]:=Taxonomy[6]+'+RCM';
      if MaterialCB42.ItemIndex=5 then Taxonomy[6]:=Taxonomy[6]+'+RCB';
    end;

    if (MaterialCB32.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[7]:='+MO99';
    if MaterialCB32.ItemIndex=1 then Taxonomy[7]:='+MON';
    if MaterialCB32.ItemIndex=2 then Taxonomy[7]:='+MOM';
    if MaterialCB32.ItemIndex=3 then Taxonomy[7]:='+MOL';
    if MaterialCB32.ItemIndex=4 then Taxonomy[7]:='+MOC';
    if MaterialCB32.ItemIndex=5 then Taxonomy[7]:='+MOCL';
    if MaterialCB32.ItemIndex=6 then Taxonomy[7]:='+SP99';
    if MaterialCB32.ItemIndex=7 then Taxonomy[7]:='+SPLI';
    if MaterialCB32.ItemIndex=8 then Taxonomy[7]:='+SPSA';
    if MaterialCB32.ItemIndex=9 then Taxonomy[7]:='+SPTU';
    if MaterialCB32.ItemIndex=10 then Taxonomy[7]:='+SPSL';
    if MaterialCB32.ItemIndex=11 then Taxonomy[7]:='+SPGR';
    if MaterialCB32.ItemIndex=12 then Taxonomy[7]:='+SPBA';
    if MaterialCB32.ItemIndex=13 then Taxonomy[7]:='+SPO';

  end;

  if (MaterialCB12.ItemIndex>10) and (MaterialCB12.ItemIndex<14) then begin
    if MaterialCB12.ItemIndex=11 then Taxonomy[5]:='E99';
    if MaterialCB12.ItemIndex=12 then Taxonomy[5]:='EU';
    if MaterialCB12.ItemIndex=13 then Taxonomy[5]:='ER';

    if (MaterialCB22.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[6]:='+ET99';
    if MaterialCB22.ItemIndex=1 then Taxonomy[6]:='+ETR';
    if MaterialCB22.ItemIndex=2 then Taxonomy[6]:='+ETC';
    if MaterialCB22.ItemIndex=3 then Taxonomy[6]:='+ETO';
  end;

  if MaterialCB12.ItemIndex=14 then begin
    Taxonomy[5]:='W';
    if (MaterialCB22.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[6]:='+W99';
    if MaterialCB22.ItemIndex=1 then Taxonomy[6]:='+WHE';
    if MaterialCB22.ItemIndex=2 then Taxonomy[6]:='+WLI';
    if MaterialCB22.ItemIndex=3 then Taxonomy[6]:='+WS';
    if MaterialCB22.ItemIndex=4 then Taxonomy[6]:='+WWD';
    if MaterialCB22.ItemIndex=5 then Taxonomy[6]:='+WBB';
    if MaterialCB22.ItemIndex=6 then Taxonomy[6]:='+WO';
  end;

  if MaterialCB12.ItemIndex=15 then Taxonomy[5]:='MATO';

  if (SystemCB12.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[8]:='L99';

  if (MaterialCB12.ItemIndex>10) and (MaterialCB12.ItemIndex<14) then begin
    if SystemCB12.ItemIndex=1 then Taxonomy[8]:='LN';
    if SystemCB12.ItemIndex=2 then Taxonomy[8]:='LWAL';
    if SystemCB12.ItemIndex=3 then Taxonomy[8]:='LO';
  end
  else if ((MaterialCB12.ItemIndex>6) and (MaterialCB12.ItemIndex<11)) or (MaterialCB12.ItemIndex=14) then begin
    if SystemCB12.ItemIndex=1 then Taxonomy[8]:='LN';
    if SystemCB12.ItemIndex=2 then Taxonomy[8]:='LFM';;
    if SystemCB12.ItemIndex=3 then Taxonomy[8]:='LPB';
    if SystemCB12.ItemIndex=4 then Taxonomy[8]:='LWAL';
    if SystemCB12.ItemIndex=5 then Taxonomy[8]:='LO';
  end
  else begin
    if SystemCB12.ItemIndex=1 then Taxonomy[8]:='LN';
    if SystemCB12.ItemIndex=2 then Taxonomy[8]:='LFM';
    if SystemCB12.ItemIndex=3 then Taxonomy[8]:='LFINF';
    if SystemCB12.ItemIndex=4 then Taxonomy[8]:='LFBR';
    if SystemCB12.ItemIndex=5 then Taxonomy[8]:='LPB';
    if SystemCB12.ItemIndex=6 then Taxonomy[8]:='LWAL';
    if SystemCB12.ItemIndex=7 then Taxonomy[8]:='LDUAL';
    if SystemCB12.ItemIndex=8 then Taxonomy[8]:='LFLS';
    if SystemCB12.ItemIndex=9 then Taxonomy[8]:='LFLSINF';
    if SystemCB12.ItemIndex=10 then Taxonomy[8]:='LH';
    if SystemCB12.ItemIndex=11 then Taxonomy[8]:='LO';
  end;

  if SystemCB12.ItemIndex>0 then begin
    if (SystemCB22.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[9]:='+DU99';
    if SystemCB22.ItemIndex=1 then Taxonomy[9]:='+DUC';
    if SystemCB22.ItemIndex=2 then Taxonomy[9]:='+DNO';
    if SystemCB22.ItemIndex=3 then Taxonomy[9]:='+DBD';
  end;

  // MOP UNTIL HERE

 if (DateCB1.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[10]:='Y99';
  if DateCB1.ItemIndex=1 then Taxonomy[10]:='YEX:'+dateE1.Text;
  if DateCB1.ItemIndex=2 then Taxonomy[10]:='YBET:'+dateE1.Text+','+dateE2.Text;
  if DateCB1.ItemIndex=3 then Taxonomy[10]:='YPRE:'+dateE1.Text;
  if DateCB1.ItemIndex=4 then Taxonomy[10]:='YAPP:'+dateE1.Text;

  // MOP HEIGHT DONE
  if HeightCB1.ItemIndex=0 then begin
    if OmitCB.checked = false then Taxonomy[11]:='H99';
  end

  else begin
    if HeightCB1.ItemIndex=1 then Taxonomy[11]:='HBET:'+noStoreysE11.Text+','+noStoreysE12.Text;
    if HeightCB1.ItemIndex=2 then Taxonomy[11]:='HEX:'+noStoreysE11.Text;
    if HeightCB1.ItemIndex=3 then Taxonomy[11]:='HAPP:'+noStoreysE11.Text;

    if (HeightCB2.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[12]:='+HB99';
    if HeightCB2.ItemIndex=1 then Taxonomy[12]:='+HBBET:'+noStoreysE21.Text+','+noStoreysE22.Text;
    if HeightCB2.ItemIndex=2 then Taxonomy[12]:='+HBEX:'+noStoreysE21.Text;
    if HeightCB2.ItemIndex=3 then Taxonomy[12]:='+HBAPP:'+noStoreysE21.Text;

    if (HeightCB3.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[12]:='+HF99';
    if HeightCB3.ItemIndex=1 then Taxonomy[13]:='+HFBET:'+noStoreysE31.Text+','+noStoreysE32.Text;
    if HeightCB3.ItemIndex=2 then Taxonomy[13]:='+HFEX:'+noStoreysE31.Text;
    if HeightCB3.ItemIndex=3 then Taxonomy[13]:='+HFAPP:'+noStoreysE31.Text;

    if (HeightCB4.ItemIndex=1) and (OmitCB.checked = false) then Taxonomy[14]:='+HD99';
    if HeightCB4.ItemIndex=1 then Taxonomy[14]:='+HD:'+noStoreysE4.Text;
  end;
  // MOP HEIGHT DONE

 if OccupancyCB1.ItemIndex=0 then begin
    if OmitCB.checked = false then Taxonomy[15]:='OC99';
  end
  else begin
    if OccupancyCB1.ItemIndex=1 then begin
      Taxonomy[15]:='RES';
      if (OccupancyCB2.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[16]:='+RES99';
      if OccupancyCB2.ItemIndex=1 then Taxonomy[16]:='+RES1';
      if OccupancyCB2.ItemIndex=2 then Taxonomy[16]:='+RES2';
      if OccupancyCB2.ItemIndex=3 then Taxonomy[16]:='+RES2A';
      if OccupancyCB2.ItemIndex=4 then Taxonomy[16]:='+RES2B';
      if OccupancyCB2.ItemIndex=5 then Taxonomy[16]:='+RES2C';
      if OccupancyCB2.ItemIndex=6 then Taxonomy[16]:='+RES2D';
      if OccupancyCB2.ItemIndex=7 then Taxonomy[16]:='+RES2E';
      if OccupancyCB2.ItemIndex=8 then Taxonomy[16]:='+RES2F';
      if OccupancyCB2.ItemIndex=9 then Taxonomy[16]:='+RES3';
      if OccupancyCB2.ItemIndex=10 then Taxonomy[16]:='+RES4';
      if OccupancyCB2.ItemIndex=11 then Taxonomy[16]:='+RES5';
      if OccupancyCB2.ItemIndex=12 then Taxonomy[16]:='+RES6';
    end
    else if OccupancyCB1.ItemIndex=2 then begin
      Taxonomy[15]:='COM';
      if (OccupancyCB2.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[16]:='+COM99';
      if OccupancyCB2.ItemIndex=1 then Taxonomy[16]:='+COM1';
      if OccupancyCB2.ItemIndex=2 then Taxonomy[16]:='+COM2';
      if OccupancyCB2.ItemIndex=3 then Taxonomy[16]:='+COM3';
      if OccupancyCB2.ItemIndex=4 then Taxonomy[16]:='+COM4';
      if OccupancyCB2.ItemIndex=5 then Taxonomy[16]:='+COM5';
      if OccupancyCB2.ItemIndex=6 then Taxonomy[16]:='+COM6';
      if OccupancyCB2.ItemIndex=7 then Taxonomy[16]:='+COM7';
      if OccupancyCB2.ItemIndex=8 then Taxonomy[16]:='+COM8';
      if OccupancyCB2.ItemIndex=9 then Taxonomy[16]:='+COM9';
      if OccupancyCB2.ItemIndex=10 then Taxonomy[16]:='+COM10';
      if OccupancyCB2.ItemIndex=11 then Taxonomy[16]:='+COM11';
    end
    else if OccupancyCB1.ItemIndex=3 then begin
      Taxonomy[15]:='MIX';
      if (OccupancyCB2.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[16]:='+MIX99';
      if OccupancyCB2.ItemIndex=1 then Taxonomy[16]:='+MIX1';
      if OccupancyCB2.ItemIndex=2 then Taxonomy[16]:='+MIX2';
      if OccupancyCB2.ItemIndex=3 then Taxonomy[16]:='+MIX3';
      if OccupancyCB2.ItemIndex=4 then Taxonomy[16]:='+MIX4';
      if OccupancyCB2.ItemIndex=5 then Taxonomy[16]:='+MIX5';
      if OccupancyCB2.ItemIndex=6 then Taxonomy[16]:='+MIX6';
    end
    else if OccupancyCB1.ItemIndex=4 then begin
      Taxonomy[15]:='IND';
      if (OccupancyCB2.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[16]:='+IND99';
      if OccupancyCB2.ItemIndex=1 then Taxonomy[16]:='+IND1';
      if OccupancyCB2.ItemIndex=2 then Taxonomy[16]:='+IND2';
    end
    else if OccupancyCB1.ItemIndex=5 then begin
      Taxonomy[15]:='AGR';
      if (OccupancyCB2.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[16]:='+AGR99';
      if OccupancyCB2.ItemIndex=1 then Taxonomy[16]:='+AGR1';
      if OccupancyCB2.ItemIndex=2 then Taxonomy[16]:='+AGR2';
      if OccupancyCB2.ItemIndex=3 then Taxonomy[16]:='+AGR3';
    end
    else if OccupancyCB1.ItemIndex=6 then begin
      Taxonomy[15]:='ASS';
      if (OccupancyCB2.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[16]:='+ASS99';
      if OccupancyCB2.ItemIndex=1 then Taxonomy[16]:='+ASS1';
      if OccupancyCB2.ItemIndex=2 then Taxonomy[16]:='+ASS2';
      if OccupancyCB2.ItemIndex=3 then Taxonomy[16]:='+ASS3';
      if OccupancyCB2.ItemIndex=4 then Taxonomy[16]:='+ASS4';
    end
    else if OccupancyCB1.ItemIndex=7 then begin
      Taxonomy[15]:='GOV';
      if (OccupancyCB2.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[16]:='+GOV99';
      if OccupancyCB2.ItemIndex=1 then Taxonomy[16]:='+GOV1';
      if OccupancyCB2.ItemIndex=2 then Taxonomy[16]:='+GOV2';
    end
    else if OccupancyCB1.ItemIndex=8 then begin
      Taxonomy[15]:='EDU';
      if (OccupancyCB2.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[16]:='+EDU99';
      if OccupancyCB2.ItemIndex=1 then Taxonomy[16]:='+EDU1';
      if OccupancyCB2.ItemIndex=2 then Taxonomy[16]:='+EDU2';
      if OccupancyCB2.ItemIndex=3 then Taxonomy[16]:='+EDU3';
      if OccupancyCB2.ItemIndex=4 then Taxonomy[16]:='+EDU4';
    end
    else if OccupancyCB1.ItemIndex=9 then begin
      Taxonomy[15]:='OCO';
    end
  end;

 if (PositionCB.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[17]:='BP99';
  if PositionCB.ItemIndex=1 then Taxonomy[17]:='BPD';
  if PositionCB.ItemIndex=2 then Taxonomy[17]:='BP1';
  if PositionCB.ItemIndex=3 then Taxonomy[17]:='BP2';
  if PositionCB.ItemIndex=4 then Taxonomy[17]:='BP3';
  if PositionCB.ItemIndex=5 then Taxonomy[17]:='BPI';

  if (PlanShapeCB.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[18]:='PLF99';
  if PlanShapeCB.ItemIndex=1 then Taxonomy[18]:='PLFSQ';
  if PlanShapeCB.ItemIndex=2 then Taxonomy[18]:='PLFSQO';
  if PlanShapeCB.ItemIndex=3 then Taxonomy[18]:='PLFR';
  if PlanShapeCB.ItemIndex=4 then Taxonomy[18]:='PLFRO';
  if PlanShapeCB.ItemIndex=5 then Taxonomy[18]:='PLFL';
  if PlanShapeCB.ItemIndex=6 then Taxonomy[18]:='PLFC';
  if PlanShapeCB.ItemIndex=7 then Taxonomy[18]:='PLFCO';
  if PlanShapeCB.ItemIndex=8 then Taxonomy[18]:='PLFD';
  if PlanShapeCB.ItemIndex=9 then Taxonomy[18]:='PLFDO';
  if PlanShapeCB.ItemIndex=10 then Taxonomy[18]:='PLFE';
  if PlanShapeCB.ItemIndex=11 then Taxonomy[18]:='PLFH';
  if PlanShapeCB.ItemIndex=12 then Taxonomy[18]:='PLFS';
  if PlanShapeCB.ItemIndex=13 then Taxonomy[18]:='PLFT';
  if PlanShapeCB.ItemIndex=14 then Taxonomy[18]:='PLFU';
  if PlanShapeCB.ItemIndex=15 then Taxonomy[18]:='PLFX';
  if PlanShapeCB.ItemIndex=16 then Taxonomy[18]:='PLFY';
  if PlanShapeCB.ItemIndex=17 then Taxonomy[18]:='PLFP';
  if PlanShapeCB.ItemIndex=18 then Taxonomy[18]:='PLFPO';
  if PlanShapeCB.ItemIndex=19 then Taxonomy[18]:='PLFI';

  if RegularityCB1.ItemIndex=0 then begin
    if OmitCB.checked = false then Taxonomy[19]:='IR99';
  end
  else begin
    if RegularityCB1.ItemIndex=1 then Taxonomy[19]:='IRRE';
    if RegularityCB1.ItemIndex=2 then begin
      Taxonomy[19]:='IRIR';
      if (OmitCB.checked = false) and (RegularityCB2.ItemIndex=0) then Taxonomy[20]:='+IRPP:IRN';
      if RegularityCB2.ItemIndex=1 then Taxonomy[20]:='+IRPP:TOR';
      if RegularityCB2.ItemIndex=2 then Taxonomy[20]:='+IRPP:REC';
      if RegularityCB2.ItemIndex=3 then Taxonomy[20]:='+IRPP:IRHO';

      if (OmitCB.checked = false) and (RegularityCB3.ItemIndex=0)  then Taxonomy[21]:='+IRVP:IRN';
      if RegularityCB3.ItemIndex=1 then Taxonomy[21]:='+IRVP:SOS';
      if RegularityCB3.ItemIndex=2 then Taxonomy[21]:='+IRVP:CRW';
      if RegularityCB3.ItemIndex=3 then Taxonomy[21]:='+IRVP:SHC';
      if RegularityCB3.ItemIndex=4 then Taxonomy[21]:='+IRVP:POP';
      if RegularityCB3.ItemIndex=5 then Taxonomy[21]:='+IRVP:SET';
      if RegularityCB3.ItemIndex=6 then Taxonomy[21]:='+IRVP:CHV';
      if RegularityCB3.ItemIndex=7 then Taxonomy[21]:='+IRVP:IRVO';

      if RegularityCB4.ItemIndex>0 then begin
        if RegularityCB4.ItemIndex=0 then Taxonomy[22]:='+IRPS:IRN';
        if RegularityCB4.ItemIndex=1 then Taxonomy[22]:='+IRPS:TOR';
        if RegularityCB4.ItemIndex=2 then Taxonomy[22]:='+IRPS:REC';
        if RegularityCB4.ItemIndex=3 then Taxonomy[22]:='+IRPS:IRHO';
      end;
      if RegularityCB5.ItemIndex>0 then begin
        if RegularityCB5.ItemIndex=0 then Taxonomy[23]:='+IRVS:IRN';
        if RegularityCB5.ItemIndex=1 then Taxonomy[23]:='+IRVS:SOS';
        if RegularityCB5.ItemIndex=2 then Taxonomy[23]:='+IRVS:CRW';
        if RegularityCB5.ItemIndex=3 then Taxonomy[23]:='+IRVS:SHC';
        if RegularityCB5.ItemIndex=4 then Taxonomy[23]:='+IRVS:POP';
        if RegularityCB5.ItemIndex=5 then Taxonomy[23]:='+IRVS:SET';
        if RegularityCB5.ItemIndex=6 then Taxonomy[23]:='+IRVS:CHV';
        if RegularityCB5.ItemIndex=7 then Taxonomy[23]:='+IRVS:IRVO';
      end;
    end
  end;

  if (WallsCB.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[24]:='EW99';
  if WallsCB.ItemIndex=1 then Taxonomy[24]:='EWC';
  if WallsCB.ItemIndex=2 then Taxonomy[24]:='EWG';
  if WallsCB.ItemIndex=3 then Taxonomy[24]:='EWE';
  if WallsCB.ItemIndex=4 then Taxonomy[24]:='EWMA';
  if WallsCB.ItemIndex=5 then Taxonomy[24]:='EWME';
  if WallsCB.ItemIndex=6 then Taxonomy[24]:='EWV';
  if WallsCB.ItemIndex=7 then Taxonomy[24]:='EWW';
  if WallsCB.ItemIndex=8 then Taxonomy[24]:='EWSL';
  if WallsCB.ItemIndex=9 then Taxonomy[24]:='EWPL';
  if WallsCB.ItemIndex=10 then Taxonomy[24]:='EWCB';
  if WallsCB.ItemIndex=11 then Taxonomy[24]:='EWO';

 if (RoofCB1.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[25]:='RSH99';
  if RoofCB1.ItemIndex=1 then Taxonomy[25]:='RSH1';
  if RoofCB1.ItemIndex=2 then Taxonomy[25]:='RSH2';
  if RoofCB1.ItemIndex=3 then Taxonomy[25]:='RSH3';
  if RoofCB1.ItemIndex=4 then Taxonomy[25]:='RSH4';
  if RoofCB1.ItemIndex=5 then Taxonomy[25]:='RSH5';
  if RoofCB1.ItemIndex=6 then Taxonomy[25]:='RSH6';
  if RoofCB1.ItemIndex=7 then Taxonomy[25]:='RSH7';
  if RoofCB1.ItemIndex=8 then Taxonomy[25]:='RSH8';
  if RoofCB1.ItemIndex=9 then Taxonomy[25]:='RSH9';
  if RoofCB1.ItemIndex=10 then Taxonomy[25]:='RSHO';

  if (RoofCB2.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[26]:='+RMT99';
  if RoofCB2.ItemIndex=1 then Taxonomy[26]:='+RMN';
  if RoofCB2.ItemIndex=2 then Taxonomy[26]:='+RMT1';
  if RoofCB2.ItemIndex=3 then Taxonomy[26]:='+RMT2';
  if RoofCB2.ItemIndex=4 then Taxonomy[26]:='+RMT3';
  if RoofCB2.ItemIndex=5 then Taxonomy[26]:='+RMT4';
  if RoofCB2.ItemIndex=6 then Taxonomy[26]:='+RMT5';
  if RoofCB2.ItemIndex=7 then Taxonomy[26]:='+RMT6';
  if RoofCB2.ItemIndex=8 then Taxonomy[26]:='+RMT7';
  if RoofCB2.ItemIndex=9 then Taxonomy[26]:='+RMT8';
  if RoofCB2.ItemIndex=10 then Taxonomy[26]:='+RM9T';
  if RoofCB2.ItemIndex=11 then Taxonomy[26]:='+RMT10';
  if RoofCB2.ItemIndex=12 then Taxonomy[26]:='+RMT11';
  if RoofCB2.ItemIndex=13 then Taxonomy[26]:='+RMTO';

  if RoofCB3.ItemIndex=0 then begin
    if OmitCB.checked = false then Taxonomy[27]:='+R99';
  end
  else begin
    if RoofCB3.ItemIndex=1 then begin
      Taxonomy[27]:='+RM';
      if (RoofCB4.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[28]:='+RM99';
      if RoofCB4.ItemIndex=1 then Taxonomy[28]:='+RM1';
      if RoofCB4.ItemIndex=2 then Taxonomy[28]:='+RM2';
      if RoofCB4.ItemIndex=3 then Taxonomy[28]:='+RM3';
    end
    else if RoofCB3.ItemIndex=2 then begin
      Taxonomy[27]:='+RE';
      if (RoofCB4.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[28]:='+RE99';
      if RoofCB4.ItemIndex=1 then Taxonomy[28]:='+RE1';
    end
    else if RoofCB3.ItemIndex=3 then begin
      Taxonomy[27]:='+RC';
      if (RoofCB4.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[28]:='+RC99';
      if RoofCB4.ItemIndex=1 then Taxonomy[28]:='+RC1';
      if RoofCB4.ItemIndex=2 then Taxonomy[28]:='+RC2';
      if RoofCB4.ItemIndex=3 then Taxonomy[28]:='+RC3';
      if RoofCB4.ItemIndex=4 then Taxonomy[28]:='+RC4';
    end
    else if RoofCB3.ItemIndex=4 then begin
      Taxonomy[27]:='+RME';
      if (RoofCB4.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[28]:='+RME99';
      if RoofCB4.ItemIndex=1 then Taxonomy[28]:='+RME1';
      if RoofCB4.ItemIndex=2 then Taxonomy[28]:='+RME2';
      if RoofCB4.ItemIndex=3 then Taxonomy[28]:='+RME3';
    end
    else if RoofCB3.ItemIndex=5 then begin
      Taxonomy[27]:='+RWO';
      if (RoofCB4.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[28]:='+RWO99';
      if RoofCB4.ItemIndex=1 then Taxonomy[28]:='+RWO1';
      if RoofCB4.ItemIndex=2 then Taxonomy[28]:='+RWO2';
      if RoofCB4.ItemIndex=3 then Taxonomy[28]:='+RWO3';
      if RoofCB4.ItemIndex=4 then Taxonomy[28]:='+RWO4';
      if RoofCB4.ItemIndex=5 then Taxonomy[28]:='+RWO5';
    end
    else if RoofCB3.ItemIndex=6 then begin
      Taxonomy[27]:='+RFA';
      if RoofCB4.ItemIndex=0 then Taxonomy[28]:='+RFA1';
      if RoofCB4.ItemIndex=1 then Taxonomy[28]:='+RFAO';
    end
    else if RoofCB3.ItemIndex=7 then begin
      Taxonomy[27]:='+RO';
    end
  end;

  if (RoofCB5.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[29]:='+RWC99';
  if RoofCB5.ItemIndex=1 then Taxonomy[29]:='+RWCN';
  if RoofCB5.ItemIndex=2 then Taxonomy[29]:='+RWCP';
  if RoofCB5.ItemIndex=3 then Taxonomy[29]:='+RTD99';
  if RoofCB5.ItemIndex=4 then Taxonomy[29]:='+RTDN';
  if RoofCB5.ItemIndex=5 then Taxonomy[29]:='+RTDP';

  if FloorCB1.ItemIndex=0 then begin
    if OmitCB.checked = false then Taxonomy[30]:='F99';
  end
  else if FloorCB1.ItemIndex=1 then begin
    Taxonomy[30]:='FN';
  end
  else begin
    if FloorCB1.ItemIndex=2 then begin
      Taxonomy[30]:='FM';
      if (FloorCB2.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[31]:='+FM99';
      if FloorCB2.ItemIndex=1 then Taxonomy[31]:='+FM1';
      if FloorCB2.ItemIndex=2 then Taxonomy[31]:='+FM2';
      if FloorCB2.ItemIndex=3 then Taxonomy[31]:='+FM3';
    end
    else if FloorCB1.ItemIndex=3 then begin
      Taxonomy[30]:='FE';
      if (FloorCB2.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[31]:='+FE99';
    end
    else if FloorCB1.ItemIndex=4 then begin
      Taxonomy[30]:='FC';
      if (FloorCB2.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[31]:='+FC99';
      if FloorCB2.ItemIndex=1 then Taxonomy[31]:='+FC1';
      if FloorCB2.ItemIndex=2 then Taxonomy[31]:='+FC2';
      if FloorCB2.ItemIndex=3 then Taxonomy[31]:='+FC3';
      if FloorCB2.ItemIndex=4 then Taxonomy[31]:='+FC4';
    end
    else if FloorCB1.ItemIndex=5 then begin
      Taxonomy[30]:='FME';
      if (FloorCB2.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[31]:='+FME99';
      if FloorCB2.ItemIndex=1 then Taxonomy[31]:='+FME1';
      if FloorCB2.ItemIndex=2 then Taxonomy[31]:='+FME2';
      if FloorCB2.ItemIndex=3 then Taxonomy[31]:='+FME3';
    end
    else if FloorCB1.ItemIndex=6 then begin
      Taxonomy[30]:='FW';
      if (FloorCB2.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[31]:='+FW99';
      if FloorCB2.ItemIndex=1 then Taxonomy[31]:='+FW1';
      if FloorCB2.ItemIndex=2 then Taxonomy[31]:='+FW2';
      if FloorCB2.ItemIndex=3 then Taxonomy[31]:='+FW3';
      if FloorCB2.ItemIndex=4 then Taxonomy[31]:='+FW4';
    end
    else if FloorCB1.ItemIndex=7 then begin
      Taxonomy[30]:='FO';
    end
  end;

  if (FloorCB3.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[32]:='+FWC99';
  if FloorCB3.ItemIndex=1 then Taxonomy[32]:='+FWCN';
  if FloorCB3.ItemIndex=2 then Taxonomy[32]:='+FWCP';

  if (FoundationsCB.ItemIndex=0) and (OmitCB.checked = false) then Taxonomy[33]:='FOS99';
  if FoundationsCB.ItemIndex=1 then Taxonomy[33]:='FOSSL';
  if FoundationsCB.ItemIndex=2 then Taxonomy[33]:='FOSN';
  if FoundationsCB.ItemIndex=3 then Taxonomy[33]:='FOSDL';
  if FoundationsCB.ItemIndex=4 then Taxonomy[33]:='FOSDN';
  if FoundationsCB.ItemIndex=5 then Taxonomy[33]:='FOSO';

  direction1:='DX';
  direction2:='DY';
  if (Direction1RB1.checked) and (OmitCB.checked = false) then begin
    direction1 := direction1+'+D99';
    direction2 := direction2+'+D99';
  end
  else if Direction1RB2.checked then begin
    direction1 := direction1+'+PF';
    direction2 := direction2+'+OF';
  end;

  ResTax:=direction1+'/'+Taxonomy[0]+Taxonomy[1]+Taxonomy[2]+'/'+Taxonomy[3]+Taxonomy[4]+'/'+direction2+'/'+Taxonomy[5]+Taxonomy[6]+Taxonomy[7]+'/'+Taxonomy[8]+Taxonomy[9]+'/'
  +Taxonomy[11]+Taxonomy[12]+Taxonomy[13]+Taxonomy[14]+'/'+Taxonomy[10]+'/'+Taxonomy[15]+Taxonomy[16]+'/'+Taxonomy[17]+'/'+Taxonomy[18]+'/'+Taxonomy[19]+Taxonomy[20]
  +Taxonomy[22]+Taxonomy[21]+Taxonomy[23]+'/'+Taxonomy[24]+'/'+Taxonomy[25]+Taxonomy[26]+Taxonomy[27]+Taxonomy[28]+Taxonomy[29]+'/'+Taxonomy[30]
  +Taxonomy[31]+Taxonomy[32]+'/'+Taxonomy[33];
  resultE.Text:=ResTax;

  //0 - Material type
  //1 - Material technology
  //2 - Material properties
  //3 - Type of lateral system
  //4 - System ductility
  //5 - Material type
  //6 - Material technology
  //7 - Material properties
  //8 - Type of lateral system
  //9 - System ductility
  //10- Date of construction
  //11- Height above the ground
  //12- Height below the ground
  //13- Height of grade
  //14- Slope of the ground
  //15- Occupancy type
  //16- Occupancy description
  //17- Position
  //18- Plan
  //19- Type of irregularity
  //20- Plan irregularity(primary)
  //21- Plan irregularity(secondary)
  //22- Vertical irregularity(primary)
  //23- Vertical irregularity(secondary)
  //24- Material of exterior walls
  //25- Roof shape
  //26- Roof covering
  //27- Roof system material
  //28- Roof system type
  //29- Roof connections
  //30- Floor system material
  //31- Floor system type
  //32- Floor connections
  //33 - Foundation


end;
end.
*/



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
    $('#MaterialCB21').on('change', taxt_MaterialCB21Select);
    $('#MaterialCB31').on('change', taxt_MaterialCB31Select);
    $('#MaterialCB41').on('change', taxt_MaterialCB41Select);
    $('#SystemCB11').on('change', taxt_SystemCB11Select);
    $('#SystemCB21').on('change', taxt_SystemCB21Select);

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
    $('#MaterialCB12').on('change', taxt_MaterialCB12Select);
    $('#MaterialCB22').on('change', taxt_MaterialCB22Select);
    $('#MaterialCB32').on('change', taxt_MaterialCB32Select);
    $('#MaterialCB42').on('change', taxt_MaterialCB42Select);
    $('#SystemCB12').on('change', taxt_SystemCB12Select);
    $('#SystemCB22').on('change', taxt_SystemCB22Select);

    var HeightCB1 = [], HeightCB2 = [], HeightCB3 = [], HeightCB4 = [];

    HeightCB1.push('Unknown number of storeys');
    HeightCB1.push('Range of the number of storeys');
    HeightCB1.push('Exact number of storeys');
    HeightCB1.push('Approximate number of storeys');
    select_populate('HeightCB1', HeightCB1);
    $('#HeightCB1').val(0);
    $('#HeightCB1').on('change', taxt_HeightCB1Select);
    $('#noStoreysE11').on('change', taxt_HeightCB1Select);
    $('#noStoreysE12').on('change', taxt_HeightCB1Select);

    HeightCB2.push('Unknown number of storeys');
    HeightCB2.push('Range of the number of storeys');
    HeightCB2.push('Exact number of storeys');
    HeightCB2.push('Approximate number of storeys');
    select_populate('HeightCB2', HeightCB2);
    $('#HeightCB2').val(0);
    $('#HeightCB2').on('change', taxt_HeightCB2Select);
    $('#noStoreysE21').on('change', taxt_HeightCB2Select);
    $('#noStoreysE22').on('change', taxt_HeightCB2Select);

    HeightCB3.push('Height above grade unknown');
    HeightCB3.push('Range of height above grade');
    HeightCB3.push('Exact height above grade');
    HeightCB3.push('Approximate height above grade');
    select_populate('HeightCB3', HeightCB3);
    $('#HeightCB3').val(0);
    $('#HeightCB3').on('change', taxt_HeightCB3Select);
    $('#noStoreysE31').on('change', taxt_HeightCB3Select);
    $('#noStoreysE32').on('change', taxt_HeightCB3Select);

    HeightCB4.push('Unknown slope');
    HeightCB4.push('Slope of the ground');
    select_populate('HeightCB4', HeightCB4);
    $('#HeightCB4').val(0);
    $('#HeightCB4').on('change', taxt_HeightCB4Select);
    $('#noStoreysE4').on('change', taxt_HeightCB4Select);



    taxt_ValidateMaterial1();
    taxt_ValidateSystem1();
    taxt_ValidateMaterial2();
    taxt_ValidateSystem2();
    /*  ValidateRoof;
        ValidateFloor; */
    taxt_ValidateHeight();
    /*
  ValidateDate;
  ValidateRegularity;
  ValidateOccupancy;
    */
    /* FIXME: MOP addition */
    taxt_BuildTaxonomy();
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
                        <td><input type="radio" id="Direction1RB1" name="sub1_xdir" checked value="false" onclick="taxt_Direction1RB1Click(this);">Unspecified direction</td>
                        <td><input type="radio" id="Direction1RB2" name="sub1_xdir" value="true"          onclick="taxt_Direction1RB2Click(this);">Parallel to street</td>
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
                        <td><input type="radio" id="Direction2RB1" name="sub1_ydir" checked value="unspec" onclick="taxt_Direction2RB1Click(this);">Unspecified direction</td>
                        <td><input type="radio" id="Direction2RB3" name="sub1_ydir" value="spec"           onclick="taxt_Direction2RB3Click(this);">Perpendicular to street</td>
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
            <div style="border:1px solid gray; margin: 4px;">
                <h4>Height:</h4>
                <table><tr>
                    <td style="width: 50%;"><div>Number of storey above ground:</div></td>
                    <td style="width: 50%;"><div>Number of storey below ground:</div></td>
                </tr><tr>
    <td><select id="HeightCB1"></select></td>
    <td><select id="HeightCB2"></select></td>
                </tr><tr>
                    <td><div style="white-space:nowrap;"><input style="width: 90%;" type="text" id="noStoreysE11"><input style="display:none; width: 45%;" type="text" id="noStoreysE12"></div></td>
                    <td><div style="white-space:nowrap;"><input style="width: 90%;" type="text" id="noStoreysE21"><input style="display:none; width: 45%;" type="text" id="noStoreysE22"></div></td>
                </tr><tr>
                    <td><div>Height of ground floor level above grade (m):</div></td>
                    <td><div>Slope of the ground (degrees):</div></td>
                </tr><tr>
    <td><select id="HeightCB3"></select></td>
    <td><select id="HeightCB4"></select></td>
                </tr><tr>
                    <td><div style="white-space:nowrap;"><input style="width: 90%;" type="text" id="noStoreysE31"><input style="display:none; width: 45%;" type="text" id="noStoreysE32"></div></td>

                    <td><div style="white-space:nowrap;"><input style="width: 90%;" type="text" id="noStoreysE4"></div></td>
               </tr></table>
            </div>
            <div style="border:1px solid gray; margin: 4px;">
                <h4>Date:</h4>
                <table class="dir_spec"><tr>
                    <td colspan=2><div>Date of construction or retrofit (yyyy):</div></td>
                </tr><tr>
                    <td><select id="????"></select></td>
                    <td><input type="text" id="????"><div>altern</div></td>
                </tr></table>
            </div>
            <div style="border:1px solid gray; margin: 4px;">
                <h4>Occupancy:</h4>

                <table class="dir_spec"><tr>
                    <td><div>Building occupancy type - general:</div></td>
                    <td><div>Building occupancy type - detail:</div></td>
                </tr><tr>
                    <td><select id="????"></select></td>
                    <td><select id="????"></select></td>
               </tr></table>

            </div>
        </div>
        <div id="main_content-3" style="position: absolute; display: none; top: 0px; width: 800px; height: 500px; background-color: #ffe6cc; /* orange */">
orange
        </div>
        <div id="main_content-4" style="position: absolute; display: none; top: 0px; width: 800px; height: 500px; background-color: #ffccff; /*violet*/">
violet
        </div>
        <div style="position: absolute; bottom: 0px; margin: 8px;" >
            <p>Taxonomy string for this building typology: </p>
            <p><input id="resultE" type="text" size="80" maxlength="120"></input></p>
            <p><input id="OmitCB" type="checkbox" onclick="taxt_OmitCBClick(this);">Omit code if corresponding parameter is unknown</p>
        </div>
    </div>
    <h1></h1>



<hr>
<address></address>
<!-- hhmts start -->Last modified: Tue Aug 19 15:43:13 CEST 2014 <!-- hhmts end -->
</body> </html>

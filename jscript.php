<input type="radio" name="myRadio" class="myDiv_1" value="myDiv_1" />Image1<br />
<input type="radio" name="myRadio" class="myDiv_2" value="myDiv_2" />Image2<br />
<input type="radio" name="myRadio" class="myDiv_3" value="myDiv_3" />Image3<br />

<div id="myDiv_1" class="shade" style="display:block;"><img>TEXT BELOW IMAGE</div>
<div id="myDiv_2" class="shade" style="display:block;"><img>TEXT BELOW IMAGE</div>
<div id="myDiv_3" class="shade" style="display:block;"><img>TEXT BELOW IMAGE</div>

<script type="text/javascript">
$(document).ready(function(){
    $('input[name="myRadio"]').click(function() {
        var selected = $(this).val();
        $(".shade").fadeOut("slow");
        $('#' + selected).fadeIn("slow");
    });
});
</script>
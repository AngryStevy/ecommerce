<script>
$(document).ready(function () {
$('input[type="radio"]').click(function () {
    if ($(this).attr("value") == "instrument") {
        $("#mp3").hide('slow');
        $('#inputQuantity').show('slow');
    }
    else if($(this).attr("value") != "instrument"){
        $("#mp3").show('slow');
        $('#inputQuantity').hide('slow');
    }
});
});
</script>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['role'] == 2):
?>

<div class="container doctor-AddTimesContainer">
  
  <form class="form-addtimes" action="jeccu/doctor_addtimes.php" method="post">
    <h2 class="form-signup-heading">Lisää työaikoja</h2>
    
    <label for="startTime">Aloitus- ja lopetusaika</label><br>
        <select class="form-control inline" id="startTime" name="startTime" required>
            <option value="07:00:00">07:00</option>
            <option value="08:00:00">08:00</option>
            <option value="09:00:00">09:00</option>
            <option value="10:00:00">10:00</option>
            <option value="11:00:00">11:00</option>
        </select>
        
        <select class="form-control inline" id="endTime" name="endTime" required>
            <option value="12:00:00">12:00</option>
            <option value="13:00:00">13:00</option>
            <option value="14:00:00">14:00</option>
            <option value="15:00:00">15:00</option>
            <option value="16:00:00">16:00</option>
            <option value="17:00:00">17:00</option>
            <option value="18:00:00">18:00</option>
        </select>
    
    <br>
        
    <label for="startDate">Työpäivät</label><br>
    <input type="text" name="startDate" id="startDate" class="form-control inline align-left" required autofocus>
    <input type="text" name="endDate" id="endDate" class="form-control inline align-right" required autofocus> <hr class="valiviiva">
    
    <button class="btn btn-lg btn-primary btn-block" type="submit" id="addTimes">Lisää ajat</button>
  </form>

</div>

<script>
$(function(){
  $("#startDate").datepicker({
        firstDay: 1,
        dateFormat: "yy-mm-dd",
        minDate: 1,
        onSelect: function (date) {
            var date2 = $('#startDate').datepicker('getDate');
            date2.setDate(date2.getDate() + 1);
            $('#endDate').datepicker('setDate', date2);
            $('#endDate').datepicker('option', 'minDate', date2);
        }
    });
    $('#endDate').datepicker({
        firstDay: 1,
        dateFormat: "yy-mm-dd",
        onClose: function () {
            var dt1 = $('#startDate').datepicker('getDate');
            var dt2 = $('#endDate').datepicker('getDate');
            if (dt2 <= dt1) {
                var minDate = $('#endDate').datepicker('option', 'minDate');
                $('#endDate').datepicker('setDate', minDate);
            }
        }
    });
});
</script>
<?php else: ?>
<h1>Sinulla ei ole oikeutta nähdä tätä sivua</h1>
<?php endif; ?>
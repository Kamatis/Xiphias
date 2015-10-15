<form class="form-horizontal" role="form">
  <div class="form-group"> 
    <label class="control-label col-sm-2" for="email">Name:</label>
    <div class="col-sm-10">
<!--
      <select class="form-control affil-combobox">
        <?php echo $affiliations; ?>
      </select>
-->
      <input type="text" class="form-control typeahead" id="input-inv-name" data-provide="typeahead">
    </div>
  </div>
  
  <div class="form-group"> 
    <label class="control-label col-sm-2" for="email">Venue:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="input-inv-venue" data-provide="typeahead">
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Date:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="date-range" id="input-inv-date">
    </div>
  </div>
</form>

<script>
$('input[name="date-range"]').daterangepicker({
        format: 'YYYY-MM-DD',
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '1900-01-01',
        maxDate: '2015-12-31',
        dateLimit: { years: 5000 },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
           'Today': [moment(), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
        },
        opens: 'left',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-primary',
        cancelClass: 'btn-default',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Cancel',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
    }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });
$(document).ready(function(){
  $('.affil-combobox').combobox();
});
</script>
$(document).ready(function() {
	 $('#tanggal').datepicker({
                    format: 'dd MM yyyy',
                    startDate: '-4y', // initial value
                    todayHighlight: true,
                    endDate : '0', // actual
                    language: 'id'
                    });
});

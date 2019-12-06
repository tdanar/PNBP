$(document).ready(function() {
    var v = new Date($('#tahun').attr('data-value'), 0, 1);
    var s = new Date($('#thn_mulai').attr('data-value'), 0, 1);
    var e = new Date($('#thn_usai').attr('data-value'), 0, 1);
    var value = v.getFullYear()+'-'+ ((v.getMonth()+1)<10 ? '0'+(v.getMonth()+1).toString() : (v.getMonth()+1)) +'-'+ ((v.getDate())<10 ? '0'+(v.getDate()).toString() : (v.getDate()));

    var ys = s.getFullYear();
    var ye = e.getFullYear();

    //console.log(value);
    $('#tanggal').datepicker({
        format: 'yyyy-mm-dd',
        language: 'id'
    });
    $('#tanggal').datepicker('setStartDate',value);
        if (ys != 1900 ){
            $('#thn_mulai').empty();
            for (i = 0; i < 4; i++) {
                $('#thn_mulai').append($('<option></option>').attr('value',(ys-i)).text(ys-i));
            }
        }
        if (ye != 1900){
            $('#thn_usai').empty();
            for (i = 0; i < 4; i++) {
                $('#thn_usai').append($('<option></option>').attr('value',(ye+i)).text(ye+i));
            }
        }

        //console.log(ys,ye);
    $('#tahun').on('change', function(){
            var s = new Date(this.value, 0, 1);
            var strings = s.getFullYear()+'-'+ ((s.getMonth()+1)<10 ? '0'+(s.getMonth()+1).toString() : (s.getMonth()+1)) +'-'+ ((s.getDate())<10 ? '0'+(s.getDate()).toString() : (s.getDate()));
            var ys = s.getFullYear();
            $('#tanggal').datepicker({
                format: 'yyyy-mm-dd',
                language: 'id'
            });
            //console.log(strings,stringe,start,end);
            $('#tanggal').datepicker('setStartDate',strings);
            if(ys != 1900){
                $('#thn_mulai').empty();
                for (i = 0; i < 4; i++) {
                    $('#thn_mulai').append($('<option></option>').attr('value',(ys-i)).text(ys-i));
                }

                    var ye = ys;
                    //console.log(ev);
                    $('#thn_usai').empty();
                    for (i = 0; i < 4; i++) {
                        $('#thn_usai').append($('<option></option>').attr('value',(ye+i)).text(ye+i));
                    }
            }else{
                $('#thn_mulai').empty();
                $('#thn_usai').empty();
                $('#thn_mulai').append($('<option></option>').attr('value','').text('Silahkan pilih tahun awal periode pengawasan'));
                $('#thn_usai').append($('<option></option>').attr('value','').text('Silahkan pilih tahun awal periode pengawasan'));
            }


    });

    $('#thn_mulai').on('change', function(){
            var e = new Date(this.value, 0, 1);
            var ye = e.getFullYear();
            $('#thn_usai').empty();
            for (i = 0; i < 4; i++) {
                $('#thn_usai').append($('<option></option>').attr('value',(ye+i)).text(ye+i));
            }
    });

});

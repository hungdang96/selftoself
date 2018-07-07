for (var d = 1; d <= 31; d++) {
    var dsub = '';
    dstr = d.toString();
    if (dstr.length < 2) {
        dsub = dstr.substring(0);
        dstr = '0' + dsub;
    }
    $("#date").append('<option value="' + dstr + '">' + dstr + '</option>');
}
$("#date").click(function () {
    $("#dayTitle").remove();
});

for (var m = 1; m <= 12; m++) {
    var msub = '';
    mstr = m.toString();
    if (mstr.length < 2) {
        msub = mstr.substring(0);
        mstr = '0' + msub;
    }
    $("#month").append('<option value="' + mstr + '">' + mstr + '</option>');
}
$("#month").click(function () {
    $("#monthTitle").remove();
});
var yearCurrent = new Date().getFullYear();
for (var y = 1970; y <= yearCurrent; y++) {
    var ysub = '';
    ystr = y.toString();
    if (ystr.length < 2) {
        ysub = ystr.substring(0);
        ystr = '0' + ysub;
    }
    $("#year").append('<option value="' + ystr + '">' + ystr + '</option>');
}
$("#year").click(function () {
    $("#yearTitle").remove();
});

function getDay() {
    var dayVal = $("#date").val();
    var monthVal = $("#month").val() + '-';
    var yearVal = $("#year").val() + '-';
    $("#dob").attr('value', yearVal + monthVal + dayVal);
}
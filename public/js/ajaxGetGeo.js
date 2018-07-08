$(document).ready(function () {
    $.ajax({
        url: "{{route('citiesList')}}",
        type: "get",
        success: function (cities) {
            console.log(cities.data);
            cities.data.map(function (val) {
                var city_id = val.city_id;
                var name = val.name;
                $("#cities").append('<option value="' + city_id + '">' + name + '</option>');
            });
        }
    });
    $("#cities").change(function () {
        $.ajax({
            url: "{{route('districtsList', $city_id)}}",
            type: "get",
            success: function (districts) {
                // console.log(provinces.data);
                districts.data.map(function (val) {
                    $("#districts").append(new Option(val.name, val.district_id));
                });
            }
        });
        $("#districts").change(function () {
            $.ajax({
                url: "{{route('wardsList', district_id)}}",
                type: "get",
                success: function (wards) {
                    // console.log(provinces.data);
                    wards.data.map(function (val) {
                        $("#districts").append(new Option(val.name, val.ward_id));
                    });
                }
            });
        })
    });
});

jQuery(document).ready(function($) {
    var file = "https://api.paseonetwork.com/mapaplus/destinos.php";
    var destinations = {};

    function loadDestinations() {
        $.getJSON(file, function(data) {
            destinations = data;

            $.each(destinations, function(country, cities) {
                var optgroup = $('<optgroup>').attr('label', country);
                $.each(cities, function(code, city) {
                    var option = $('<option>').attr('value', code).text(city);
                    optgroup.append(option);
                });
                $('#zone').append(optgroup);
            });

            $('#zone').select2({
                placeholder: "Selecciona Destinos",
                allowClear: true
            });
        }).fail(function(jqxhr, textStatus, error) {
            var err = textStatus + ", " + error;
            console.error("Error al cargar el archivo JSON de destinos: " + err);
        });
    }

    loadDestinations();

    $('#search_destinations_form').submit(function(event) {
        var selectElement = $('#zone');
        var selectedValues = selectElement.val();
        if (selectedValues.length > 0) {
            this.action = this.action + '?zone=' + encodeURIComponent(selectedValues.join(','));
        }
    });
});

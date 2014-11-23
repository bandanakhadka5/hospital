$(function() {

	var timeout;

	$patient_typeahead = $('.patient-typeahead');

	if($patient_typeahead.length > 0) {

		$('.patient-typeahead').typeahead({

			source : function(typeahead, query) {

				if (timeout) {
                	clearTimeout(timeout);
            	}

	            timeout = setTimeout(function() {

					$.ajax({
						url: '/hospital/patients/typeahead/'+encodeURI(query),
						success: function(data){
							typeahead.process(data);
						}
					});

	            }, 300);

			},
			property: 'FullIdentifier',
			onselect: function(obj) {
				$('.patient-typeahead[data-name="patient_id"]').attr('data-value', obj['ID']);
				$('form input[name="patient_id"]').attr('value', obj['ID']);
				$('form input[name="patient_id_text"]').val(obj['FullIdentifier']);
			},
			autoselect: true
		});
    }
});
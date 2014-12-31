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

    $disease_typeahead = $('.disease-typeahead');

	if($disease_typeahead.length > 0) {

		$('.disease-typeahead').typeahead({

			source : function(typeahead, query) {

				if (timeout) {
                	clearTimeout(timeout);
            	}

	            timeout = setTimeout(function() {

					$.ajax({
						url: '/hospital/diseases/typeahead/'+encodeURI(query),
						success: function(data){
							typeahead.process(data);
						}
					});

	            }, 300);

			},
			property: 'FullIdentifier',
			onselect: function(obj) {
				$('.disease-typeahead[data-name="diagnosis"]').attr('data-value', obj['FullIdentifier']);
				$('form input[name="disease_id"]').attr('value', obj['ID']);
				$('form input[name="diagnosis"]').val(obj['FullIdentifier']);
			},
			autoselect: true
		});
    }

    $disease_typeahead_1 = $('.disease-typeahead-1');

	if($disease_typeahead_1.length > 0) {

		$('.disease-typeahead-1').typeahead({

			source : function(typeahead, query) {

				if (timeout) {
                	clearTimeout(timeout);
            	}

	            timeout = setTimeout(function() {

					$.ajax({
						url: '/hospital/diseases/typeahead/'+encodeURI(query),
						success: function(data){
							typeahead.process(data);
						}
					});

	            }, 300);

			},
			property: 'FullIdentifier',
			onselect: function(obj) {
				$('.disease-typeahead-1[data-name="diagnosis_1"]').attr('data-value', obj['FullIdentifier']);
				$('form input[name="disease_id_1"]').attr('value', obj['ID']);
				$('form input[name="diagnosis_1"]').val(obj['FullIdentifier']);
			},
			autoselect: true
		});
    }
});
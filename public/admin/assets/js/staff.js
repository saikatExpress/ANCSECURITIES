$(document).ready(function() {

    let currentStep = 0;
    const steps = $('.form-step');
    const totalSteps = steps.length;

    function showStep(stepIndex) {
        steps.hide();
        $(steps[stepIndex]).show();
    }

    function validateStep(stepIndex) {
        let isValid = true;
        $(steps[stepIndex]).find('input, select').each(function() {
            if ($(this).prop('required') && !$(this).val()) {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        return isValid;
    }

    $('.btn-next').on('click', function() {
        if (validateStep(currentStep)) {
            currentStep++;
            if (currentStep >= totalSteps) {
                currentStep = totalSteps - 1;
            }
            showStep(currentStep);
        }
    });

    $('.btn-prev').on('click', function() {
        currentStep--;
        if (currentStep < 0) {
            currentStep = 0;
        }
        showStep(currentStep);
    });

    showStep(currentStep);

    $('#successAlert').show();

    setTimeout(function() {
        $('#successAlert').fadeOut('slow');
    }, 3000);

    $('.errorAlert').show();

    setTimeout(function() {
        $('.errorAlert').fadeOut('slow');
    }, 3000);
});

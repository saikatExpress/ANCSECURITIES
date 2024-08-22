$(document).ready(function() {
    let currentStep = 1;
    const totalSteps = 5; // Adjust if you add/remove steps

    const showStep = (step) => {
        for (let i = 1; i <= totalSteps; i++) {
            $(`#step-${i}`).toggle(i === step);
        }
        $('#prev-btn').toggle(step > 1);
        $('#next-btn').text(step === totalSteps ? 'Done' : 'Next');
    };

    $('#next-btn').on('click', function() {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
        } else {
            // Handle "Done" button
            $('#user-form').submit(); // Submit the form if it's the last step

            // Change button class to success
            $(this).removeClass('btn-primary').addClass('btn-success');
        }
    });

    $('#prev-btn').on('click', function() {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });

    showStep(currentStep);
});

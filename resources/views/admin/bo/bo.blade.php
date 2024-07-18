<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BO Form Wizard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your custom styles */
        .step-content {
            display: none;
        }
        .step-content.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">BO Form Wizard</div>
                    <div class="card-body">
                        <!-- Step wizard -->
                        <div id="step-wizard">
                            <!-- Step 1 Content -->
                            <div id="step-1" class="step-content active">
                                <form id="step-1-form">
                                    <p>Step 1 Content</p>
                                    <div class="form-group">
                                        <label for="field1">Field 1:</label>
                                        <input type="text" class="form-control required" id="field1" name="field1">
                                    </div>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </form>
                            </div>
                            <!-- Step 2 Content -->
                            <div id="step-2" class="step-content">
                                <form id="step-2-form">
                                    <p>Step 2 Content</p>
                                    <div class="form-group">
                                        <label for="field2">Field 2:</label>
                                        <input type="text" class="form-control required" id="field2" name="field2">
                                    </div>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                    <button type="button" class="btn btn-secondary prev-step">Back</button>
                                </form>
                            </div>
                            <!-- Step 3 Content -->
                            <div id="step-3" class="step-content">
                                <form id="step-3-form">
                                    <p>Step 3 Content</p>
                                    <div class="form-group">
                                        <label for="field3">Field 3:</label>
                                        <input type="text" class="form-control required" id="field3" name="field3">
                                    </div>
                                    <button type="button" class="btn btn-primary submit">Submit</button>
                                    <button type="button" class="btn btn-secondary prev-step">Back</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <script>
        $(document).ready(function() {
            var currentStep = 1;
            var totalSteps = $('#step-wizard .step-content').length;

            $('.next-step').click(function() {
                // Validate current step form before proceeding
                var isValid = true;
                $('#step-' + currentStep + '-form .required').each(function() {
                    if (!$(this).val()) {
                        isValid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                if (isValid) {
                    $('#step-' + currentStep).removeClass('active');
                    currentStep++;
                    $('#step-' + currentStep).addClass('active');
                }
            });

            $('.prev-step').click(function() {
                $('#step-' + currentStep).removeClass('active');
                currentStep--;
                $('#step-' + currentStep).addClass('active');
            });

            $('.submit').click(function() {
                // Handle form submission here
                var isValid = true;
                $('#step-' + currentStep + '-form .required').each(function() {
                    if (!$(this).val()) {
                        isValid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                if (isValid) {
                    alert('Form submitted successfully!');
                    // You can submit the form using AJAX or redirect as needed
                }
            });
        });
    </script>
</body>
</html>

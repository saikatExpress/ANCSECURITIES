<div class="row">
    @foreach($permissions as $permission)
        <div class="col-md-4">
            <div class="card mb-3 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center" style="box-shadow: 0 0 10px rgba(0,0,0,0.1);border-radius: 4px;padding: 10px 12px 10px; margin: 5px 5px 5px;">
                        <div class="icon-container mr-3">
                            <i class="fas fa-shield-alt fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h5 style="text-transform: uppercase;font-weight: 600;font-size: 16px;color: chocolate;" class="card-title mb-1">{{ $permission->name }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<style>
    .icon-container {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f0f0f0;
        border-radius: 50%;
    }
    .card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
</style>

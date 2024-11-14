<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Technician Report</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 CSS and JS (Load after jQuery) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" integrity="sha512-YHJ091iDoDM1PZZA9QLuBvpo0VXBBiGHsvdezDoc3p56S3SOMPRjX+zlCbfkOV5k3BmH5O9FqrkKxBRhkdtOkQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js" integrity="sha512-XBxUMC4YQcL60PavAScyma2iviXkiWNS5Yf+A0LZRWI1PNiGHkp66yPQxHWDSlv6ksonLAL2QMrUlCKq4NHhSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <h1>Insert Technician Report</h1>
    @if($errors->any())
        <div class="error_checking">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('techreport.store') }}" onsubmit="return confirmAction('Are you sure you want to save this report?')">
        @csrf 
        @method('post')

        <div class="technician_dropdown">
            <label for="technician_id">Technician</label>
            <select class ="technician" name="technician_id" id="technician_id" required>
                <option value="" selected>Select a Technician</option>
                @foreach($techprofile as $technician)
                    <option value="{{ $technician->technician_id }}">{{ $technician->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="customer_dropdown">
            <label for="customer_id">Customer</label>
            <select name="customer_id" id="customer_id" required>
                <option value="" selected>Select a Customer</option>
                @foreach($customer as $cust)
                    <option value="{{ $cust->customer_id }}">{{ $cust->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="sku_dropdown">
    <label for="sku_id">Serial No. </label>
    <select name="sku_id" id="sku_id" required>
        <option value="" selected>Select Serial</option>
        @foreach($inventoryitem as $item)
            <option value="{{ $item->sku_id }}">{{ $item->serial_number }}</option>
        @endforeach
    </select>
</div>


        <div class="service_dropdown">
            <label for="service_id">Service</label>
            <select name="service_id" id="service_id" required>
                <option value="" selected>Select a Service</option>
                @foreach($service as $srv)
                    <option value="{{ $srv->service_id }}">{{ $srv->service_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="date_of_completion">
            <label>Date of Completion</label>
            <input type="date" name="date_of_completion" required>
        </div>

        <div class="payment_type_dropdown">
            <label for="payment_type">Payment Type</label>
            <select name="payment_type" id="payment_type" required>
                <option value="" selected>Select Payment Type</option>
                @foreach($paymenttype as $type)
                    <option value="{{ $type }}">{{ ucfirst(str_replace('_', ' ', $type)) }}</option>
                @endforeach
            </select>
        </div>

        <div class="payment_method_dropdown">
            <label for="payment_method">Payment Method</label>
            <select name="payment_method" id="payment_method" required>
                <option value="" selected>Select Payment Method</option>
                @foreach($paymentmethod as $method)
                    <option value="{{ $method }}">{{ ucfirst($method) }}</option>
                @endforeach
            </select>
        </div>

        <div class="status_dropdown">
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="" selected>Select Status</option>
                @foreach($statuses as $status)
                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>

        <div class="remarks">
            <label>Remarks</label>
            <input type="text" name="remarks" placeholder="Remarks">
        </div>

        <div class="cost">
            <label>Cost</label>
            <input type="number" step="0.01" name="cost" placeholder="Cost" required min="0">
            
        </div>
    
        

        <div class="submit">
            <input type="submit" value="Save Report">
        </div>
    </form>

    <script src="{{ asset('js/confirmation.js') }}"></script>


    <script type="text/javascript">
  $(document).ready(function() {
    $('#technician_id, #customer_id, #service_id,#sku_id,#payment_type,#payment_method,#status').select2();
});
</script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Technician Report</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" integrity="sha512-YHJ091iDoDM1PZZA9QLuBvpo0VXBBiGHsvdezDoc3p56S3SOMPRjX+zlCbfkOV5k3BmH5O9FqrkKxBRhkdtOkQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js" integrity="sha512-XBxUMC4YQcL60PavAScyma2iviXkiWNS5Yf+A0LZRWI1PNiGHkp66yPQxHWDSlv6ksonLAL2QMrUlCKq4NHhSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f7f7f7;
        }
        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            width: 600px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h1 {
            font-size: 1.2em;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }
        .form-group select,
        .form-group input {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 0.9em;
        }
        .full-width {
            grid-column: span 2;
        }
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .button-group input[type="submit"],
        .button-group .cancel-btn {
            width: 48%;
            padding: 10px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            color: #fff;
            font-weight: bold;
        }
        .button-group input[type="submit"] {
            background-color: #2c3e50;
        }
        .button-group .cancel-btn {
            background-color: #e74c3c;
        }
        .back-group {
            margin-bottom: 20px;
        }
        .back-group a {
            background-color: #3b5998;
            color: white;
            padding: 8px 15px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 0.9em;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            display: inline-block;
        }
        .back-group a:hover {
            background-color: #314e75;
        }
        .error_checking {
            color: red;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="back-group">
        <a href="{{ route('techreport.index') }}">← Back</a>
    </div>

    <div class="form-container">
        <h1>View Technician Report</h1>

        @if($errors->any())
            <div class="error_checking">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


            <div class="form-grid">
              
             <div class="form-group">
                    <label for="technician_id">Technician</label>
                    <input 
                        type="text" 
                        name="technician_id" 
                        id="technician_id" 
                        placeholder="Technician" 
                        value="{{ old('technician_id', $techreport->techprofile->name ?? '') }}" 
                        readonly>
            </div>



            <div class="form-group">
                <label for="customer_id">Customer</label>
                <input 
                    type="text" 
                    name="customer_id" 
                    id="customer_id" 
                    placeholder="Customer" 
                    value="{{ old('customer_id', $techreport->customer->name ?? '') }}" 
                    readonly>
            </div>


            <div class="form-group">
                <label for="sku_id">Serial No.</label>
                <input 
                    type="text" 
                    name="sku_id" 
                    id="sku_id" 
                    placeholder="Serial No." 
                    value="{{ old('sku_id', $techreport->inventoryitem->serial_number ?? 'Not bought in-store') }}" 
                    readonly>
            </div>

            <div class="form-group">
                    <label for="service_id">Service</label>
                    <input 
                        type="text" 
                        name="service_id" 
                        id="service_id" 
                        placeholder="Service" 
                        value="{{ old('service_id', $techreport->service->service_name ?? '') }}" 
                        readonly>
            </div>

            <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input 
                        type="text" 
                        name="product_name" 
                        id="product_name" 
                        placeholder="Product Name" 
                        value="{{ $techreport->Inventoryitem && $techreport->Inventoryitem->inventory 
                                    ? $techreport->Inventoryitem->inventory->product_name 
                                    : 'Not bought in-store' }}" 
                                readonly>
            </div>

            <div class="form-group">
                    <label for="date_of_completion">Date of Completion</label>
                    <input 
                        type="date" 
                        name="date_of_completion" 
                        value="{{ old('date_of_completion', $techreport->date_of_completion) }}" 
                        readonly>
            </div>


            
            <div class="form-group">
                    <label for="payment_type">Payment Type</label>
                    <input 
                        type="text" 
                        name="payment_type" 
                        id="payment_type" 
                        placeholder="Payment Type" 
                        value="{{ old('payment_type', ucfirst(str_replace('_', ' ', $techreport->payment_type ?? ''))) }}" 
                        readonly>
            </div>

            <div class="form-group">
                    <label for="payment_method">Payment Method</label>
                    <input 
                        type="text" 
                        name="payment_method" 
                        id="payment_method" 
                        placeholder="Payment Method" 
                        value="{{ old('payment_method', ucfirst($techreport->payment_method ?? '')) }}" 
                        readonly>
            </div>

            <div class="form-group">
                    <label for="status">Status</label>
                    <input 
                        type="text" 
                        name="status" 
                        id="status" 
                        placeholder="Status" 
                        value="{{ old('status', ucfirst($techreport->status ?? '')) }}" 
                        readonly>
            </div>

                <div class="form-group">
                    <label for="remarks">Remarks</label>
                    <input 
                        type="text" 
                        name="remarks" 
                        placeholder="Remarks" 
                        value="{{ old('remarks', $techreport->remarks) }}" 
                        readonly>
                </div>

                <div class="form-group">
                    <label for="cost">Cost</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="cost" 
                        placeholder="Cost" 
                        value="{{ old('cost', $techreport->cost) }}" 
                        readonly>
                </div>

                

        </form>
    </div>

    

</body>
</html>

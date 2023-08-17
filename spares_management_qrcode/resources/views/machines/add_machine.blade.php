@extends('layout.app')
@section('content')

<div class="add_machine_bg" style="display: flex; justify-content: space-around; gap: 1%;">
    <div style="width: 500px; max-width: 20%;">

    </div>
    <div style="padding-left: 30px; padding-right: 10px;">
        <div style="margin: 0px auto; font-size: 36px; font-weight: 700; text-align: center;">
            <u> Add Machine Details </u>
        </div>
        <div>
            <form action="/add_machine" method="post" enctype="multipart/form-data">
                @csrf
                @if($machine)
                <input type="hidden" name="id" value="{{$machine->id}}">
                @endif
                <div><span id="customer_style">Machine Id<span style="color: #F72C1D; padding-left: 1px;">*</span></span>
                </div>
                <input id="machine_id" name="machine_id" type="text"
                    placeholder="Enter Machine Id" @if($machine) value="{{$machine->machine_id}}" @endif required>
                    
                <div><span id="customer_style">Machine Name<span style="color: #F72C1D; padding-left: 1px;">*</span></span>
                </div>
                <input id="machine_name" name="machine_name" type="text"
                    placeholder="Enter Machine Name" @if($machine) value="{{$machine->machine_name}}" @endif required>

                <div><span id="customer_style">Machine Type<span style="color: #F72C1D; padding-left: 1px;">*</span></span>
                </div>
                <input id="machine_type" name="machine_type" type="text"
                    placeholder="Enter Machine Type" @if($machine) value="{{$machine->machine_type}}" @endif required>

                    
                <div><span id="customer_style">Department<span
                    style="color: #F72C1D; padding-left: 1px;">*</span></span>
                </div>
                <select name="department" id="department1" class="department" required">
                    <option value="" disabled selected> -- Select Department --</option>
                    <option value="mcl" @if($machine && $machine->department == 'mcl') selected @endif>MCL</option>
                    <option value="ccl" @if($machine && $machine->department == 'ccl') selected @endif>CCL</option>
                    <option value="mechanical" @if($machine && $machine->department == 'mechanical') selected @endif>Mechanical Maintenance</option>
                </select>
                
                <div><span id="customer_style">Last Maintenance Date
                    <!-- <span style="color: #F72C1D; padding-left: 1px;">*</span> -->
                </span>
                </div>
                <input id="last_maintenance_date" name="last_maintenance_date" type="date"
                    placeholder="Enter Last Maintenance Date" @if($machine) value="{{$machine->last_maintenance_date}}" @endif>
                <br>
                
                <div><span id="customer_style">Due Maintenance Date
                    <!-- <span style="color: #F72C1D; padding-left: 1px;">*</span> -->
                </span>
                </div>
                <input id="due_maintenance_date" name="due_maintenance_date" type="date"
                    placeholder="Enter Due Maintenance Date" @if($machine) value="{{$machine->due_maintenance_date}}" @endif>
                <br>
                
                <div><span id="customer_style">Operation Start Date
                    <!-- <span style="color: #F72C1D; padding-left: 1px;">*</span> -->
                </span>
                </div>
                <input id="operation_start_date" name="operation_start_date" type="date"
                    placeholder="Enter Operation Start Date" @if($machine) value="{{$machine->operation_start_date}}" @endif>
                <br>
                
                <div><span id="customer_style"> Description
                    <span style="color: #F72C1D; padding-left: 1px;">*</span>
                </span>
                </div>
                <textarea name="description" cols="30" rows="4"
                    style=" padding: 10px; color: #000103; border-radius: 6px; width: 90%;"
                    placeholder="Description of machine."  required>@if($machine){{$machine->description}} @endif</textarea>

                
                <div style="margin-top: 20px;">
                    <label for="imageInput" style="float: right; margin-right: 10%;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="120" height="36" viewBox="0 0 190 56" fill="none">
                            <rect x="0.5" y="0.5" width="189" height="55" rx="4.5" fill="white" fill-opacity="0.8"
                                stroke="black" />
                            <path
                                d="M26.015 37.25V30.635H19.4V26.365H26.015V19.75H30.285V26.365H36.9V30.635H30.285V37.25H26.015ZM60.0019 19.4H62.4379L69.5779 39H67.4919L65.9659 34.8H56.4879L54.9619 39H52.8759L60.0019 19.4ZM57.2019 32.84H65.2379L61.2199 21.808L57.2019 32.84ZM82.5125 18H84.4725V39H82.5125V36.382C82.0272 37.278 81.3599 38.0013 80.5105 38.552C79.6705 39.0933 78.6719 39.364 77.5145 39.364C76.4972 39.364 75.5452 39.1727 74.6585 38.79C73.7719 38.4073 72.9879 37.88 72.3065 37.208C71.6345 36.5267 71.1072 35.7427 70.7245 34.856C70.3419 33.9693 70.1505 33.0173 70.1505 32C70.1505 30.9827 70.3419 30.0307 70.7245 29.144C71.1072 28.248 71.6345 27.464 72.3065 26.792C72.9879 26.1107 73.7719 25.5787 74.6585 25.196C75.5452 24.8133 76.4972 24.622 77.5145 24.622C78.6719 24.622 79.6705 24.8973 80.5105 25.448C81.3599 25.9893 82.0272 26.7033 82.5125 27.59V18ZM77.5285 37.46C78.5272 37.46 79.3859 37.2173 80.1045 36.732C80.8232 36.2373 81.3739 35.5747 81.7565 34.744C82.1485 33.9133 82.3445 32.9987 82.3445 32C82.3445 30.9733 82.1485 30.0493 81.7565 29.228C81.3645 28.3973 80.8092 27.7393 80.0905 27.254C79.3719 26.7687 78.5179 26.526 77.5285 26.526C76.5392 26.526 75.6385 26.7733 74.8265 27.268C74.0145 27.7533 73.3659 28.4113 72.8805 29.242C72.3952 30.0727 72.1525 30.992 72.1525 32C72.1525 33.0173 72.3999 33.9413 72.8945 34.772C73.3892 35.5933 74.0425 36.2467 74.8545 36.732C75.6759 37.2173 76.5672 37.46 77.5285 37.46ZM99.2469 18H101.207V39H99.2469V36.382C98.7616 37.278 98.0943 38.0013 97.2449 38.552C96.4049 39.0933 95.4063 39.364 94.2489 39.364C93.2316 39.364 92.2796 39.1727 91.3929 38.79C90.5063 38.4073 89.7223 37.88 89.0409 37.208C88.3689 36.5267 87.8416 35.7427 87.4589 34.856C87.0763 33.9693 86.8849 33.0173 86.8849 32C86.8849 30.9827 87.0763 30.0307 87.4589 29.144C87.8416 28.248 88.3689 27.464 89.0409 26.792C89.7223 26.1107 90.5063 25.5787 91.3929 25.196C92.2796 24.8133 93.2316 24.622 94.2489 24.622C95.4063 24.622 96.4049 24.8973 97.2449 25.448C98.0943 25.9893 98.7616 26.7033 99.2469 27.59V18ZM94.2629 37.46C95.2616 37.46 96.1203 37.2173 96.8389 36.732C97.5576 36.2373 98.1083 35.5747 98.4909 34.744C98.8829 33.9133 99.0789 32.9987 99.0789 32C99.0789 30.9733 98.8829 30.0493 98.4909 29.228C98.0989 28.3973 97.5436 27.7393 96.8249 27.254C96.1063 26.7687 95.2523 26.526 94.2629 26.526C93.2736 26.526 92.3729 26.7733 91.5609 27.268C90.7489 27.7533 90.1003 28.4113 89.6149 29.242C89.1296 30.0727 88.8869 30.992 88.8869 32C88.8869 33.0173 89.1343 33.9413 89.6289 34.772C90.1236 35.5933 90.7769 36.2467 91.5889 36.732C92.4103 37.2173 93.3016 37.46 94.2629 37.46ZM111.295 39V19.4H117.567C118.613 19.4 119.555 19.6567 120.395 20.17C121.235 20.674 121.903 21.36 122.397 22.228C122.901 23.0867 123.153 24.0527 123.153 25.126C123.153 26.2087 122.897 27.184 122.383 28.052C121.879 28.92 121.203 29.606 120.353 30.11C119.513 30.614 118.585 30.866 117.567 30.866H113.255V39H111.295ZM113.255 28.906H117.413C118.104 28.906 118.734 28.738 119.303 28.402C119.882 28.0567 120.339 27.5947 120.675 27.016C121.021 26.428 121.193 25.7653 121.193 25.028C121.193 24.2907 121.021 23.6327 120.675 23.054C120.339 22.466 119.882 22.004 119.303 21.668C118.734 21.3227 118.104 21.15 117.413 21.15H113.255V28.906ZM125.678 39V25H127.638V26.932C128.133 26.2227 128.777 25.658 129.57 25.238C130.363 24.818 131.227 24.608 132.16 24.608C132.701 24.608 133.224 24.678 133.728 24.818L132.93 26.764C132.538 26.6427 132.155 26.582 131.782 26.582C131.026 26.582 130.331 26.7687 129.696 27.142C129.071 27.5153 128.571 28.0147 128.198 28.64C127.825 29.2653 127.638 29.9607 127.638 30.726V39H125.678ZM140.916 39.364C139.628 39.364 138.452 39.0327 137.388 38.37C136.334 37.7073 135.489 36.8207 134.854 35.71C134.229 34.59 133.916 33.3533 133.916 32C133.916 30.9733 134.098 30.0167 134.462 29.13C134.826 28.234 135.326 27.45 135.96 26.778C136.604 26.0967 137.351 25.5647 138.2 25.182C139.05 24.7993 139.955 24.608 140.916 24.608C142.204 24.608 143.376 24.9393 144.43 25.602C145.494 26.2647 146.339 27.156 146.964 28.276C147.599 29.396 147.916 30.6373 147.916 32C147.916 33.0173 147.734 33.9693 147.37 34.856C147.006 35.7427 146.502 36.5267 145.858 37.208C145.224 37.88 144.482 38.4073 143.632 38.79C142.792 39.1727 141.887 39.364 140.916 39.364ZM140.916 37.404C141.868 37.404 142.722 37.1567 143.478 36.662C144.244 36.158 144.846 35.4953 145.284 34.674C145.732 33.8527 145.956 32.9613 145.956 32C145.956 31.02 145.732 30.1193 145.284 29.298C144.836 28.4673 144.23 27.8047 143.464 27.31C142.708 26.8153 141.859 26.568 140.916 26.568C139.964 26.568 139.106 26.82 138.34 27.324C137.584 27.8187 136.982 28.4767 136.534 29.298C136.096 30.1193 135.876 31.02 135.876 32C135.876 33.008 136.105 33.9227 136.562 34.744C137.02 35.556 137.631 36.2047 138.396 36.69C139.162 37.166 140.002 37.404 140.916 37.404ZM156.311 39.364C155.023 39.364 153.847 39.0327 152.783 38.37C151.728 37.7073 150.883 36.8207 150.249 35.71C149.623 34.59 149.311 33.3533 149.311 32C149.311 30.9733 149.493 30.0167 149.857 29.13C150.221 28.234 150.72 27.45 151.355 26.778C151.999 26.0967 152.745 25.5647 153.595 25.182C154.444 24.7993 155.349 24.608 156.311 24.608C157.599 24.608 158.77 24.9393 159.825 25.602C160.889 26.2647 161.733 27.156 162.359 28.276C162.993 29.396 163.311 30.6373 163.311 32C163.311 33.0173 163.129 33.9693 162.765 34.856C162.401 35.7427 161.897 36.5267 161.253 37.208C160.618 37.88 159.876 38.4073 159.027 38.79C158.187 39.1727 157.281 39.364 156.311 39.364ZM156.311 37.404C157.263 37.404 158.117 37.1567 158.873 36.662C159.638 36.158 160.24 35.4953 160.679 34.674C161.127 33.8527 161.351 32.9613 161.351 32C161.351 31.02 161.127 30.1193 160.679 29.298C160.231 28.4673 159.624 27.8047 158.859 27.31C158.103 26.8153 157.253 26.568 156.311 26.568C155.359 26.568 154.5 26.82 153.735 27.324C152.979 27.8187 152.377 28.4767 151.929 29.298C151.49 30.1193 151.271 31.02 151.271 32C151.271 33.008 151.499 33.9227 151.957 34.744C152.414 35.556 153.025 36.2047 153.791 36.69C154.556 37.166 155.396 37.404 156.311 37.404ZM168.717 21.346V25H172.917V26.96H168.717V39H166.757V26.96H164.839V25H166.757V21.346C166.757 20.6647 166.92 20.0487 167.247 19.498C167.583 18.938 168.031 18.4947 168.591 18.168C169.151 17.832 169.771 17.664 170.453 17.664C170.947 17.664 171.423 17.762 171.881 17.958C172.347 18.154 172.763 18.4433 173.127 18.826L171.727 20.212C171.577 20.0253 171.386 19.8807 171.153 19.778C170.929 19.6753 170.695 19.624 170.453 19.624C169.977 19.624 169.566 19.792 169.221 20.128C168.885 20.464 168.717 20.87 168.717 21.346Z"
                                fill="black" />
                        </svg>
                    </label>
                    <input type="file" name="media[]" id="imageInput" accept="image/jpg, image/jpeg, image/png" multiple
                        style="visibility:hidden;">
                </div>
                <div id="">
                    <!-- <span class="page_title_two">Uploaded Proofs :</span> -->
                    <div id="imagePreview" class="row g-2" style="justify-content: center; margin: 10px auto">
                    </div>
                </div>
                <br>
                <div style="display: flex; justify-content: center;">
                    <button id="button" type="submit">@if($machine) Update @else Add @endif</button>
                </div>
                <br>
                <br>
            </form>
        </div>
    </div>

</div>

<script>
    // Function to handle image preview
    function handleImagePreview(event) {
        var files = event.target.files;
    
        if (files && files.length > 0) {
            var imagePreview = document.getElementById("imagePreview");
            imagePreview.innerHTML = ""; // Clear previous previews
    
            var newFiles = new DataTransfer();
    
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();
    
                reader.onload = (function(file) {
                    return function(e) {
                        var previewContainer = document.createElement("div");
                        previewContainer.classList.add("image-preview-container");
    
                        var previewImage = document.createElement("img");
                        previewImage.src = e.target.result;
                        previewImage.alt = "Preview";
                        previewImage.style.width = "120px";
                        previewImage.style.height = "120px";
                        previewImage.style.marginTop = "10px";
                        previewImage.style.marginBottom = "10px";
    
                        var deleteButton = document.createElement("a");
                        deleteButton.classList.add("delete-button");
                        deleteButton.innerHTML =
                            '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="25" viewBox="0 0 22 25" fill="none"><circle cx="11" cy="11" r="10" fill="#F7F6F5" stroke="#F72C1D" stroke-width="2" /><path d="M7.36 15L10.432 10.776L7.396 6.6H9.202L11.338 9.54L13.48 6.6H15.286L12.25 10.776L15.322 15H13.504L11.338 12.024L9.178 15H7.36Z" fill="#0D1B2A" /></svg>';
                        deleteButton.addEventListener("click", function() {
                            previewContainer.remove();
                            // Remove the corresponding file from the newFiles object
                            for (var j = 0; j < newFiles.files.length; j++) {
                                if (newFiles.files[j] === file) {
                                    newFiles.items.remove(j);
                                    break;
                                }
                            }
                            // Update the input field with the new file selection
                            document.getElementById("imageInput").files = newFiles.files;
                        });
    
                        previewContainer.appendChild(previewImage);
                        previewContainer.appendChild(deleteButton);
                        imagePreview.appendChild(previewContainer);
    
                        // Add the file to the newFiles object
                        newFiles.items.add(file);
                    };
                })(file);
    
                reader.readAsDataURL(file);
            }
        }
    }
    
    // Attach event listener to the file input element
    document.getElementById("imageInput").addEventListener("change", handleImagePreview);
    </script>
    
<style>
    .image-preview-container {
        display: flex;
        justify-content: center;
        margin-right: 10px;
        position: relative;
        margin: 10px auto;
    }
    
    .delete-button {
        position: absolute;
        top: 170px;
        border: none;
        background: transparent;
        font-weight: bold;
        font-size: 18px;
        cursor: pointer;
        position: absolute;
        margin-top: -170px;
        margin-right: -110px;
    }
</style>
<style>
    #customer_style {
        font-weight: bold;
        font-size: 18px;
        display: flex;
        margin-top: 20px;
        margin-bottom: 10px;
        color: #1F7FD9;
    }

    #new div {
        display: inline-block;
    }

    #new {
        vertical-align: middle;
    }

    button{

        width: 50%;
        padding: 12px;
        font-size: 25px;
        background: linear-gradient(90deg, #01EAFE 0%, #1F7FD9 100%, rgba(0, 0, 0, 1) 100%);
        font-style: normal;
        font-weight: bold;
        border: none;
        color: white;
        border-radius: 15px;
        cursor: pointer;
        font-family: 'Open Sans', sans-serif;
        margin-top: 15px;
    }

    #line {
        border: none;
        outline: none;
        border-bottom: 2px solid black;
        width: 100%;
        height: 30px;
    }

    .department {
        border: none;
        outline: none;
        border-bottom: 2px solid black;
        width: 90%;
        font-size: 18px;
        /* height: 30px; */
        border-radius: 0.4em;
    }

    #order_amount {
        border: none;
        outline: none;
        border-bottom: 2px solid black;
        width: 100%;
        height: 30px;
    }

    #machine_id {
        border: none;
        outline: none;
        border-bottom: 2px solid black;
        width: 90%;
    }
    
    #last_maintenance_date {
        border: none;
        outline: none;
        border-bottom: 2px solid black;
        width: 90%;
    }
    #due_maintenance_date {
        border: none;
        outline: none;
        border-bottom: 2px solid black;
        width: 90%;
    }
    #operation_start_date {
        border: none;
        outline: none;
        border-bottom: 2px solid black;
        width: 90%;
    }

    #machine_type {
        border: none;
        outline: none;
        border-bottom: 2px solid black;
        width: 90%;
    }

    #machine_name {
        border: none;
        outline: none;
        border-bottom: 2px solid black;
        width: 90%;
    }
    .ref_no {
        border: none;
        outline: none;
        border-bottom: 2px solid black;
        width: 90%;
        height: 30px;
    }

    input::placeholder {
        font-size: 18px;
        color: rgba(0, 0, 0, 0.5);
        padding-left: 10px;
    }
    input{
        padding: 10px 20px;
        width: 90%;
    }
    select{
        padding: 10px 20px;
        /* height: 60px; */
    }
</style>
<style>
.add_machine_bg{
    background-image: url('/dist/assets/add_machine_bg1.png');

    /* Optional background properties */
    background-size: cover; /* Adjust the size of the image to cover the entire div */
    background-repeat: no-repeat; /* Prevent the image from repeating */
    background-position: center center;
    background-attachment: fixed;
    background-size: cover;
    width: 100%;
    
    /* height: calc(100vh - 75px); */
    height: 100%;
    margin-top: -20px;
    /* &::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0.4; 
    } */
}
</style>
@endsection
@extends('layout.app')
@section('content')
<div class="container-fluid" style="padding-right: var(--bs-gutter-x,0rem); padding-left: var(--bs-gutter-x,0rem);">
    
    @if($department)
    <!-- Add department bar on top -->
    <div class="scrollmenu">

        <a id="mcl" type="button" href="/dashboard/machines/mcl" name="answer" id="btn0"
            class="notifier new">
            MCL
            <!-- <span class="badge_style" id="mcl1"></span> -->
        </a>
        <a id="ccl" type="button" href="/dashboard/machines/ccl" name="answer" id="btn0"
            class="notifier new">
            CCL
            <!-- <span class="badge_style" id="ccl1"></span> -->
        </a>

        <a id="mechanical_maintenance" type="button" href="/dashboard/machines/mechanical_maintenance" name="answer"
            id="btn3" class="notifier new">
            Mechanical Maintenance
            <!-- <span class="badge_style" id="mechanical_maintenance1"></span> -->
        </a>

        <a id="all" type="button" href="/dashboard/machines/all" name="answer" id="btn4"
            class="notifier new">
            All
            <!-- <span class="badge_style" id="all1"></span> -->
        </a>

    </div>
    @endif
    <div class="container text-center">
        <br>
        <!-- <br> -->
        <div class="mt-2"></div>
        @if(count($machines)>0)
        @foreach($machines as $machine)
        <div style="margin-bottom:20px;" class="maindiv">
            <form action="/machine/{{$machine->id}}">
                <button type="submit" class="button">
                    <div style="display: flex; justify-content: left; gap: 4%; flex-wrap: wrap; align-items: safe ;">
                        <div style="width: 45%;">
                            <img style="border-radius: 6px;" src="{{$machine->medias[0]->thumbnail_path}}" alt="{{$machine->machine_name}} image" srcset="" width="95%">
                        </div>
                        <div style="word-wrap: normal; width: 48%;">
                            <div style="word-wrap: break-word; margin: 5px 0px;">
                                <span style="font-weight: 600; font-size: 18px;"> Id: @if($machine->machine_id){{$machine->machine_id}} @else Not Available @endif</span>
                            </div>
                            <div style="word-wrap: break-word; margin: 5px 0px;">
                                <span style="font-weight: 500; font-size: 16px; "> Name: @if($machine->machine_name){{$machine->machine_name}} @else Not Available @endif</span>
                            </div>
                            <div style="word-wrap: break-word; margin: 5px 0px;">
                                <span style="font-weight: 500; font-size: 16px; "> Department: @if($machine->department && $machine->department == 'mcl') MCL 
                                    @elseif($machine->department && $machine->department == 'ccl') CCL
                                    @elseif($machine->department && $machine->department == 'mechanical_maintenance') Mechanical Maintenance
                                    @else Not Available @endif</span>
                            </div>
                            <div style="word-wrap: break-word; margin: 5px 0px;">
                                <span style="font-weight: 500; font-size: 16px; "> Type: @if($machine->machine_type){{$machine->machine_type}} @else Not Available @endif</span>
                            </div>
                        </div>
                    </div>
                    <div style="width: 90%; word-wrap: break-word; margin: 10px;">
                        <span style="margin-right: 5px;">Description :</span>
                        @if($machine->description)
                        {{$machine->description}}
                        @else Not Available @endif
                    </div>
                </button>
            </form>
            </div>
        @endforeach
        @else
        <h5 style="margin: 20px auto; color:#F72C1D;"> No Machines Found</h5>
        @endif
    </div>

    @if($machines_count > $per_page)
        <br>
        <div class="pagination-wrapper" style="width: 100%; max-width: 415px; margin: auto;">
            <div style="display: flex;justify-content: left; align-items: center;margin-bottom: -8px;">
                

                <select onchange="rows_per_page();" name="rows_per_page" id="rows_per_page">
                    <!-- <option value="1" @selected($per_page=="1" )>1</option>
                    <option value="2" @selected($per_page=="2" )>2</option> -->
                    <option value="10" @selected($per_page=="10" )>10</option>
                    <option value="20" @selected($per_page=="20" )>20</option>
                    <option value="30" @selected($per_page=="30" )>30</option>
                    <option value="50" @selected($per_page=="50" )>50</option>
                    <!-- <option value="all" @selected($per_page=="all" )>All</option> -->
                </select>
                <label for="rows_per_page" style="font-size: 18px;">: Rows</label>
                <!-- </form> -->
            </div>
            <div style="margin-top: 15px;">
                {{$machines->appends($filters)->links('pagination::custom')}}
            </div>
        </div>
    @endif

</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="/dist/frontend/js/jquery_local.js"></script>
<script src="/dist/frontend/js/jquery_form_local.js"></script>

<script>
    jQuery(document).ready(function() {
        <?php if ( $department=="mcl" ) {?>
        $('#mcl').css('color', 'white').css('background', 'linear-gradient(90deg, #01EAFE 0%, #1F7FD9 100%, rgba(0, 0, 0, 1) 100%)')
        $('#mcl1').css('background', '#F7941D')
        <?php } ?>
    
        <?php if ( $department=="ccl" ) {?>
        $('#ccl').css('color', 'white').css('background', 'linear-gradient(90deg, #01EAFE 0%, #1F7FD9 100%, rgba(0, 0, 0, 1) 100%)')
        $('#ccl1').css('background', '#F7941D')
        <?php } ?>
    
        <?php if ( $department=="mechanical_maintenance" ) {?>
        $('#mechanical_maintenance').css('color', 'white').css('background', 'linear-gradient(90deg, #01EAFE 0%, #1F7FD9 100%, rgba(0, 0, 0, 1) 100%)')
        $('#mechanical_maintenance1').css('background', '#F7941D')
        <?php } ?>
    
        <?php if ( $department == "all" ) {?>
        $('#all').css('color', 'white').css('background', 'linear-gradient(90deg, #01EAFE 0%, #1F7FD9 100%, rgba(0, 0, 0, 1) 100%)')
        $('#all1').css('background', '#F7941D')
        <?php } ?>
        
    });
</script>
<script>
    function rows_per_page() {
        let per_page = document.getElementById('rows_per_page').value;
        let session_value =
            `{{http_build_query(\Session::get('filters'))}}`
    
        const parseResult = session_value.replaceAll('&amp;', '&');
    
        window.location.href =
            `/dashboard/machines/{{$department}}?${parseResult}&rows_per_page=${per_page}`;
    }
</script>

<style>
    .maindiv {
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.25) inset;
        background-color: #F7F6F5;
        width: 100%;
        max-width: 415px;
        margin: auto;
        border-radius: 5px;
    
    }
    .button {
    background-color: transparent;
    border: none;
    border-radius: 5px;
    width: 100%;
    max-width: 415px;
    margin: auto;
    text-align: left;
    cursor: pointer;
    padding: 10px;
    color: black;
}
</style>
<script>
$(document).ready(function() {
    $(".scrollmenu").animate({
        scrollLeft: $(`#{{$department}}`).offset().left - 20
    }, 2000);
});
</script>
<style>
    div.scrollmenu {
    /* position: relative; */
    z-index: 5;
    background-color: white;
    overflow: auto;
    white-space: nowrap;
    margin-top: -25px;
    /* margin-left: 5px; */
    position: fixed;
    width: 100%;
    left: 0;

}

.scrollmenu a {
    display: inline-block;
    color: #0D1B2A;
    text-align: center;
    text-decoration: none;
    font-weight: 600;
    padding: 8px 10px;
    background-color: #D9D9D9;
    border-radius: 10px;
    margin: 8px 4px 8px 4px;

}

</style>
@endsection
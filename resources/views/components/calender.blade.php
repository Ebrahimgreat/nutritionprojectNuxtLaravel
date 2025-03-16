
@props(['dateValue'=>[] ])
@props(['habits'=>[]])
@props(['habit'=>[]])
@props(['information'=>[]])




@php













$month='';
$dateNew= new dateTime(today());
$month=$dateNew->format('t');
$day=$dateNew->format('d');
$months=[12];



@endphp


<style>





    .month {
        padding: 70px 25px;
        width: 100%;
        background: #1abc9c;
        text-align: center;
    }
    .month ul li{
        color:white;
        font-size:20px;
        text-transform:uppercase;
        letter-spacing:3px;
    }
    .days{
        padding:10px 0;
        background:#eeee;
        margin:0;

    }
    .days li {
        list-style-type:none;
        display:inline-block;
        width:13.6%;
        color:#7777;
        margin-bottom:5px;
        font-size:12px;


    }


    @media screen and (max-width:720px) {
        .weekdays li, .days li {width: 13.1%;}
    }

    @media screen and (max-width: 420px) {
        .weekdays li, .days li {
            width: 12.5%;
        }

        .days li .active {
            padding: 2px;
        }
    }


    @media screen and (max-width: 290px) {
        .weekdays li, .days li {
            width: 12.2%;
        }
    }
</style>





<div class="month">
    Aughust
</div>











    <ul class="days">



    @for($i = 1; $i <=$month; $i++)


        @if(date('d')==$i)
            @foreach($dateValue as $date)
                @if($i==$date)

                    <li style="border:1px solid black; color:yellow">

                        {{$i}}</li>
                    @endif
                @endforeach
            @elseif(date('d')!=$i)
                      @foreach($dateValue as $date)
                          @if($i==$date)
                <li style="border:1px solid black; color:yellow">







                        <div x-data="{open:false}">
                            <button x-on:click="open=! open">{{$i}}</button>
                            <div x-show="open">


                                @php
                        $keyCount = count(array_keys($information));
                        $count=0;

                    @endphp
                    Summary For the day:
                    @foreach($information as $info)
                        @if($i==$info[0])
                            <br>
                            {{$info[1]}}
                    <br>
                            {{$info[3]}}
                    <br>
                            @endif
                        @endforeach





                </li>
                              @php
                              $i=$i+1;
                              @endphp
                    @endif
                @endforeach
                          <li style= "border-radius:20px; color:black; font-weight:bold;">
                              {{$i}}
                          </li>

              @endif

    @endfor



        </ul>



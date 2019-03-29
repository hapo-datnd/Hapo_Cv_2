<?php
/**
 * Created by PhpStorm.
 * User: Dat
 * Date: 3/5/2019
 * Time: 3:03 PM
 */
?>

<div class="content-3">
    <div class="container">
        <div class="row">
            <div class="left-content-3 flex-column flex col-md-6 col-12">
                <h2><span class="before">work</span> <span class="behind">experience</span></h2>
                <p id="workExperienceTitle{{$cv->id}}" class="p1">{{$cv->work_experience_title}}</p>
                <div class="main">
                    @if(count($cv->workExperiences) !== 0)
                        <div class="main-1">
                        </div>
                        <div class="main-2 main-2-left flex-column flex ">
                            @foreach($cv->workExperiences as $work)
                                <div class="main-3 flex-row flex main-work position-relative" id="work-number{{$work->id}}">
                                    <img class="img-1" alt="Icon Left" src="{{asset('icon/Polygon.png')}}">
                                    <div class="main-3-center">
                                    </div>
                                    <div class="main-3-box main-3-box-1 flex-column flex">
                                        <h3><span class="year">(<span class="get-start-time-work" id="startTimeWork{{$work->id}}">{{$work->start_time}}</span> - <span class="get-end-time-work" id="endTimeWork{{$work->id}}">{{$work->end_time}}</span>)</span><span class="get-company-name" id="companyName{{$work->id}}">{{$work->company()->first()->name}}</span></h3>
                                        <h4 class="get-company-position" id="companyPosition{{$work->id}}">{{$work->position}}</h4>
                                        <p class="get-work-content para" id="workContent{{$work->id}}" >{{$work->work_content}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="content-3-button flex-row flex">
                    <button type="button" onclick="addButton3()" class="d-none content-3-btn flex-row flex justify-content-center align-items-center">
                        Add work expience
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="right-content-3 flex-column flex col-md-6 col-12">
                <h2><span class="before">educa</span><span class="behind">tion</span></h2>
                <p id="educationTitle{{$cv->id}}" class="p1">{{$cv->education_title}}</p>
                <div class="main">
                    @if(count($cv->education) !== 0)
                        <div class="main-1">
                        </div>
                        <div class="main-2 main-2-right flex-column flex">
                            @foreach($cv->education as $educationNow)
                                <div class="main-3 flex-row flex position-relative main-education" id="edu-number{{$educationNow->id}}">
                                    <img class="img-1" alt="Icon Left" src="{{asset('icon/Polygon.png')}}">
                                    <div class="main-3-center">
                                    </div>
                                    <div class="main-3-box main-3-box-1 flex-column flex">
                                        <h3><span class="year">(<span class="get-start-time-edu" id="eduStartTime{{$educationNow->id}}">{{$educationNow->start_time}}</span> - <span class="get-end-time-edu" id="eduEndTime{{$educationNow->id}}">{{$educationNow->end_time}}</span>)</span><span class="get-edu-name" id="educationName{{$educationNow->id}}">{{$educationNow->school()->first()->name}}</span></h3>
                                        <h4 class="get-edu-position" id="educationPosition{{$educationNow->id}}">{{$educationNow->position}}</h4>
                                        <p class="get-achievement para" id="achievement{{$educationNow->id}}" >{{$educationNow->achievement}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="content-3-button flex-row flex">
                    <button type="button" onclick="addButton4()" class="d-none content-3-btn-right flex-row flex justify-content-center align-items-center">
                        Add education
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

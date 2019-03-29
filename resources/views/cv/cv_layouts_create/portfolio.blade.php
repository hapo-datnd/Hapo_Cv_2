<?php
/**
 * Created by PhpStorm.
 * User: Dat
 * Date: 3/5/2019
 * Time: 3:03 PM
 */
?>
<div class="content-4">

    <div class="container">
        <div class="row">
            <h2 class="col-12"><span class="before">portf</span><span class="behind">olio</span></h2>
            <div class="menu col-12">
                <ul>
                    <li><button>all</button></li>
                    <li><button>feature</button></li>
                    <li><button>2018</button></li>
                    <li><button>2017</button></li>
                    <li><button><i class="fas fa-angle-double-right"></i></button></li>
                </ul>
            </div>
            <div class="col-12 sumProject grid-container">
                <div  id="project1" style="background: #FD7038" class="grid-item position-relative item1 show-box show-box-1 box-1-1 flex justify-content-center align-items-center flex-row">
                    <form class="d-none" action="">
                        <input name="project-name" aria-label="project"  type="text" id="projectName1" class="get-id-final-project get-project-name" value="CV Project">
                        <input name="customer" aria-label="project" type="text" id="customer1" class="get-customer" value="Haposoft">
                        <input name="time-start" aria-label="project" type="date" id="timeStart1" class="get-time-start" value="2018-08-18">
                        <input name="time-end" aria-label="project" type="date" id="timeEnd1" class="get-time-end" value="2018-08-18">
                        <input name="description" aria-label="project" type="text" id="description1" class="get-description" value="DATN">
                        <input name="position" aria-label="project" type="text" id="position1" class="get-position" value="Project manager">
                        <input name="responsibility" aria-label="project" type="text" id="responsibility1" class="get-responsibility" value="Leader">
                        <input name="technology" aria-label="project" type="text" id="technology1" class="get-technology" value="Laravel">
                        <input name="team-size" aria-label="project" type="number" id="teamSize1" class="get-team-size" value="6">
                        <input  aria-label="project" id="feature1" name="feature" class="get-feature" value="0">
                        <input name="color" type="color" aria-label="project" class="get-color-display" id="color1" value='#FD7038'>
                        <input  aria-label="project" id="size1" name="size" class="get-size-display" value="1">
                    </form>
                    <button type="button" onclick="deleteProjectButton(1)" class="position-absolute button-delete-project"><i class="m-0 fas fa-minus"></i></button>
                    <img onclick="setAttributeToModal(1)" data-toggle="modal" data-target="#myModal" alt="Project" src="{{asset('image/project.png')}}">
                </div>
                <div class="grid-item item3 show-box-1 flex justify-content-center align-items-center flex-column">
                    <button type="button" onclick="addButton5()" class="flex-row flex justify-content-center align-items-center">
                        Add project
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <h1 id="headerModal">Project-Name</h1>
                        <form>
                            <div class="form-group col-md-12">
                                <label for="name-project-modal">Name-project</label>
                                <input type="text" class="form-control" onblur="validateInfoModal(this.id, 0, 32)" id="nameProjectModal" placeholder="Name-project">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="customer-project-modal">Customer</label>
                                <input type="text" class="form-control" onblur="validateInfoModal(this.id, 0, 32)" id="customerProjectModal" placeholder="Customer">
                            </div>
                            <div class="form-group flex">
                                <div class="form-group col-md-6 mb-0">
                                    <label for="time-end-project-modal">Time Start</label>
                                    <input type="date" class="form-control" id="timeStartProjectModal" placeholder="Time Start">
                                </div>
                                <div class="form-group col-md-6 mb-0">
                                    <label for="time-start-project-modal">Time End</label>
                                    <input type="date" class="form-control" id="timeEndProjectModal"  placeholder="Time End">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description-project-modal">Description</label>
                                <input type="text" class="form-control" onblur="validateInfoModal(this.id, 0, 100)" id="descriptionProjectModal" placeholder="Description">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="position-project-modal">Position</label>
                                <input type="text" class="form-control" onblur="validateInfoModal(this.id, 0, 32)" id="positionProjectModal" placeholder="Position">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="responsibility-project-modal">Responsibility</label>
                                <input type="text" class="form-control" onblur="validateInfoModal(this.id, 0, 32)" id="responsibilityProjectModal" placeholder="Responsibility">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="technology-project-modal">Technology</label>
                                <input type="text" class="form-control" onblur="validateInfoModal(this.id, 0, 32)" id="technologyProjectModal" placeholder="Technology">
                            </div>
                            <div class="form-group flex">
                                <div class="form-group col-md-6 mb-0">
                                    <label for="team-size-modal">Team Size</label>
                                    <input type="number" onblur="validateTeamSize(this.id, 1, 100)" class="form-control" id="teamSizeModal" placeholder="Team Size">
                                </div>
                                <div class="form-group col-md-6 mb-0">
                                    <label for="feature-project-modal">Feature select</label>
                                    <select class="form-control" id="featureProjectModal">
                                        <option id="featureModal" value="1">Feature</option>
                                        <option id="noneFeatureModal" value="0">None Feature</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group flex">
                                <div class="form-group col-md-6 mb-0">
                                    <label for="feature-project-modal">Size Display</label>
                                    <select class="form-control" id="sizeDisplayModal">
                                        <option id="size1Modal" value="1">Size 1</option>
                                        <option id="size2Modal" value="2">Size 2</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 mb-0">
                                    <label for="feature-project-modal">Color Display</label>
                                    <input class="form-control" id="colorModal" type="color">
                                </div>
                            </div>
                            <input type="number" class="d-none" value="" id="idProjectNow">
                            <div class="form-group col-md-12 flex justify-content-center align-content-center">
                                <button type="button" class="btn col-md-6  btn-outline-success" onclick="setAttributeToForm($('#idProjectNow').val())">Save</button>
                                <button type="button" class="btn col-md-6  btn-outline-dark" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

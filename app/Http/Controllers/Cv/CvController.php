<?php

namespace App\Http\Controllers\Cv;

use App\Http\Requests\CvRequest;
use App\Http\Requests\UpdateCvRequest;
use App\Models\Education;
use App\Models\Portfolio;
use App\Models\School;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;
use App\Models\Cv;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\WorkExperience;
use Illuminate\Support\Facades\Storage;
use App\Models\Reference;
use phpDocumentor\Reflection\Types\Object_;

class CvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin_login_form');
        }
        else {
            $cvs = Cv::paginate(Cv::PAGINATION);
            return view('admin.cv', compact('cvs'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::guard('user')->check()) {
            return view('cv.create');
        }
        else {
            return redirect()->route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CvRequest $request)
    {
        if($request->hasFile('file')) {
            $fileName = uniqid() . '.' . 'jpg';
            $request->file('file')->storeAs('public/avatar', $fileName);
        }

        $userId = Auth::id();
        $data = array_merge($request->all(), ["user_id" => $userId, "image" => $fileName, "image_mini" => $fileName]);
        $cv = Cv::create($data);
        $cv->save();


        if ($request->skill_pros) {
            $skillPros = $request->skill_pros;
            foreach ($skillPros as $skillPro) {
                $skillId = Skill::firstOrCreate(['name' => strtoupper($skillPro['name']), 'type' => Skill::PROFESSIONAL])->id;
                $cv->skills()->attach($cv->id,['percent' => $skillPro['percent'], 'skill_id' => $skillId]);
            }
        }

        if ($request->skill_pers) {
            $skillPers = $request->skill_pers;
            foreach ($skillPers as $skillPer) {
                $skillId = Skill::firstOrCreate(['name' => strtoupper($skillPer['name']), 'type' => Skill::PERSONAL])->id;
                $cv->skills()->attach($cv->id,['percent' => $skillPer['percent'], 'skill_id' => $skillId]);
            }
        }

        if ($request->work_experiences) {
            $workExperiences = $request->work_experiences;
            foreach ($workExperiences as $workExperience) {
                $companyId = Company::firstOrCreate(['name' =>  strtoupper($workExperience['company_name']),])->id;
                $data = array_merge((array)$workExperience, ["company_id" => $companyId, 'cv_id' => $cv->id]);
                WorkExperience::create($data);
            }
        }

        if ($request->edu_experiences) {
            $eduExperiences = $request->edu_experiences;
            foreach ($eduExperiences as $eduExperience) {
                $schoolId = School::firstOrCreate(['name' =>  strtoupper($eduExperience['school_name']),])->id;
                $data = array_merge((array)$eduExperience, ["school_id" => $schoolId, 'cv_id' => $cv->id]);
                Education::create($data);
            }
        }

        if ($request->portfolios) {
            $portfolios = $request->portfolios;
            foreach ($portfolios as $portfolio) {
                $data = array_merge((array)$portfolio, ['cv_id' => $cv->id]);
                Portfolio::create($data);
            }
        }

        if ($request->content_slide) {
            $content = $request->content_slide;
            for ($i = 0; $i < count($content); $i++) {
                $files = $request->file('image_slide');
                if (!empty($files)) {
                    $nameImage = uniqid() . '.' . 'jpg';
                    $files[$i]->storeAs('public/avatarFooter', $nameImage);
                }
                Reference::create(["content"=>$content[$i], "image" => $nameImage, "cv_id" => $cv->id]);
            }
        }
        return ($cv->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cv = Cv::findOrFail($id);
        $skills = Cv::findOrFail($id)->skills;
        if (Auth::guard('user')->id() === $cv->user_id) {

            return view('cv.show', compact('cv','skills'));
        }
        if ($cv->status === 0) {
            return redirect()->route("home")->with('message',"You can't see this Cv!");
        }
            return view('cv.show', compact('cv','skills'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cv = Cv::findOrFail($id);
        if(Auth::guard('user')->id() === $cv->user_id) {
            $skills = Cv::findOrFail($id)->skills;
            return view('cv.edit', compact('cv','skills'));
        }
        return redirect()->route('home')->with('message',"That isn't your Cv! You can't access!");


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCvRequest $request, $id)
    {


        $dataCv = $request->all();

        if($request->hasFile('file')) {
            $fileName = uniqid() . '.' . 'jpg';
            $request->file('file')->storeAs('public/avatar', $fileName);
            $dataCv = array_merge($dataCv,["image" => $fileName, "image_mini" => $fileName]);
        }

        $cv = Cv::findOrFail($id);
        $cv->update($dataCv);

        if ($request->skill_pros) {
            $skillPros = $request->skill_pros;
            foreach ($skillPros as $skillPro) {
                $skillId = Skill::firstOrCreate(['name' => strtoupper($skillPro['name']), 'type' => Skill::PROFESSIONAL])->id;
                $data[$skillId] = ['percent' => $skillPro['percent'], 'cv_id' => $cv->id];
                $cv->skills()->sync($data);
            }
        } else {
            $cv->skills()->detach();
        }

        if ($request->skill_pers) {
            $skillPers = $request->skill_pers;
            foreach ($skillPers as $skillPer) {
                $skillId = Skill::firstOrCreate(['name' => strtoupper($skillPer['name']), 'type' => Skill::PERSONAL])->id;
                $data[$skillId] = ['percent' => $skillPer['percent'], 'cv_id' => $cv->id];
                $cv->skills()->sync($data);
            }
        } else {
            $cv->skills()->detach();
        }

        $cv->workExperiences()->delete();
        if ($request->work_experiences) {
            $workExperiences = $request->work_experiences;
            foreach ($workExperiences as $workExperience) {
                $companyId = Company::firstOrCreate(['name' =>  strtoupper($workExperience['company_name']),])->id;
                $data = array_merge((array)$workExperience, ["company_id" => $companyId, 'cv_id' => $cv->id]);
                WorkExperience::create($data);
            }
        }

        $cv->education()->delete();
        if ($request->edu_experiences) {
            $eduExperiences = $request->edu_experiences;
            foreach ($eduExperiences as $eduExperience) {
                $schoolId = School::firstOrCreate(['name' =>  strtoupper($eduExperience['school_name']),])->id;
                $data = array_merge((array)$eduExperience, ["school_id" => $schoolId, 'cv_id' => $cv->id]);
                Education::create($data);
            }
        }


        $cv->portfolios()->delete();
        if ($request->portfolios) {
            $portfolios = $request->portfolios;
            foreach ($portfolios as $portfolio) {
                $data = array_merge((array)$portfolio, ['cv_id' => $cv->id]);
                Portfolio::create($data);
            }
        }

        if ($request->slides) {
            $slides =  $request->slides;
            $references = $cv->references;
            foreach ($references as $reference) {
                $count = 0;
                foreach ($slides as $slide) {
                    if ($reference->id === (int)$slide['id']) {
                        if (gettype($slide['image']) == 'object') {
                            $files = $slide['image'];
                            $nameImage = uniqid() . '.' . 'jpg';
                            $files->storeAs('public/avatarFooter', $nameImage);
                            $reference->update(["content" => $slide['content'], "image" => $nameImage]);

                        } else {
                            $reference->update(["content" => $slide['content']]);

                        }
                        $count++;
                    }
                }
                if ($count === 0) {
                    $reference->delete();
                }

            }
        }


        if ($request->slide_edit) {
            $slideEdits = $request->slide_edit;
            foreach ($slideEdits as $slideEdit) {
                if (gettype($slideEdit['image']) == 'object') {
                    $files = $slideEdit['image'];
                    $nameImage = uniqid() . '.' . 'jpg';
                    $files->storeAs('public/avatarFooter', $nameImage);
                    Reference::create(["content" => $slideEdit['content'], "image" => $nameImage, "cv_id" => $cv->id]);
                }
            }
        }

    }

    public function updateStatus(Request $request,$id)
    {
        $cv = Cv::findOrFail($id);
        $cv->status = $request->status;
        $cv->save();
        if (Auth::guard('admin')->check()){
            return redirect()->route('cvs.index')->with('message','You have changed status of '.$cv->title.' successful!');
        }
        elseif(Auth::guard('user')->check()) {
            return redirect()->route('home')->with('message','You have changed status of '.$cv->title.' successful!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cv::findOrFail($id)->delete();
        if (Auth::guard('admin')->check()) {
            return redirect()->route('cvs.index')->with('message','You have deleted CV successfully!');
        } elseif (Auth::guard('user')->check()) {
            return redirect()->route('home')->with('message','You have deleted successfully!');
        }


    }
}

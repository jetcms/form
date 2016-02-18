<?php namespace JetCMS\Form\Http\Controllers;

use Sentinel;
use Mail;
use Request;
use Input;
use Validator;
use SEO;
use App\Http\Controllers\Controller;

class MailController extends Controller {

    Protected $validator = null;

    /**
     * @param $name
     * @return \Illuminate\View\View
     */
    public function postMailController($name)
    {
        $config = config('jetcms.form.'.$name);

        if (!$config) {
            return redirect('/form/default');
        }

        $this->validator = Validator::make(
            Request::all(),
            (isset($config['validator'][0])) ? $config['validator'][0] : [],
            (isset($config['validator'][1])) ? $config['validator'][1] : []
        );


        if ($this->validator->fails())
        {
            $input = $this->generateInput($config);
            $title = $config['title'];
            $description = $config['description'];

            SEO::setTitle($title);
            SEO::setDescription($description);

            return view('jetcms.form::tpl.main',compact('input','title','description'));
        }else{
            return $this->send($config);
        }
    }

    /**
     * @param $config
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function send($config){

        $subscription = $config['role_subscription'];
        if (!is_array($subscription)){
            $subscription = [$subscription];
        }

        $value = $this->getValue($config);

        foreach($subscription as $val) {
            $role = Sentinel::findRoleBySlug($val);
            if($role) {
                foreach($role->users as $user){
                   $this->mail($value,$user,$config);
                }
            }
        }
        return redirect($config['redirect']);
    }

    /**
     * @param $value
     * @param $user
     * @param $config
     */
    protected function mail($value, $user, $config){
        Mail::send('jetcms.form::tpl.email', $value, function($message)
        use ($user,$config)
        {
            $message->to($user->email, $user->first_name.' '.$user->last_name)->subject($config['title']);
        });
    }

    /**
     * @param $config
     * @return array
     */
    protected function getValue($config){

        $value = [];
        foreach(Request::all() as $key => $val) {
            if ($key != '_token') {
                $value[] = ['lable' => $key, 'value' => $val];
            }
        }

        return [
            'title' => $config['title'],
            'description' => $config['description'],
            'name_site' => $config['name_site'],
            'value' => $value
        ];
    }


    /**
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function getMailController($name)
    {
        $config = config('jetcms.form.'.$name);

        if (!$config) {
            return redirect('/form/default');
        }

        $input = $this->generateInput($config);
        $title = $config['title'];
        $description = $config['description'];

        SEO::setTitle($title);
        SEO::setDescription($description);

        return view('jetcms.form::tpl.main',compact('input','title','description'));
    }

    /**
     * @param $config
     * @return array
     */
    protected function generateInput($config){
        $input = [];

        foreach($config['input'] as $val) {
            if (view()->exists('jetcms.form::input.' . $val['type'])) {
                $tpl = 'jetcms.form::input.' . $val['type'];
            } else {
                $tpl = 'jetcms.form::input.text';
            }

            $v = [
                'lable' => $val['lable'],
                'name' => $val['name'],
                'value' => old($val['name'],Request::get($val['name'],null)),
                'error' => ($this->validator) ? $this->validator->messages()->first($val['name']) : false

            ];
            $input[] = view($tpl, $v);
        }
        return $input;
    }


}


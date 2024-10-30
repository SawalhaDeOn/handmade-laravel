<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\PatientModel;
use App\Models\TawkHistory;
use App\Models\User;
use App\Models\WhatsappHistory;
use App\Models\WhatsappHistoryModel;
use Carbon\Carbon;
use Gr8Shivam\SmsApi\Exception\Exception;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Locale;

class LoginController extends Controller
{

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1])) {
            $user = User::where('email', $request->email)->first();
            $user->update([
                'last_login_at' => Carbon::now()->toDateTimeString()
            ]);
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'title' => 'Invalid credentials',
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public
    function webhookwa(Request $request)
    {
        if ($request->hub_token == 'EMC')
            return $request->hub_challenge;

        else
            return $request->hub_challenge;
    }

    public
    function webhookwa2(Request $request)
    {
        $dd = $request->all();
        $d = $dd["entry"][0]["changes"][0];
        if ($d['value']["metadata"]['phone_number_id'] == "100100129601912" && $request->type == "EMC")
            return 0;

        if ($d['value'] && count($d['value']) > 0) {
            if (array_key_exists('messages', $d['value']) && is_array($d['value']['messages'])) {
                for ($i = 0; $i < count($d['value']['messages']); $i++) {
                    $c = $d['value']['messages'][$i];

                    $w = new WhatsappHistory();

                    if ($c['type'] == 'interactive') {

                        $w->body = $c['interactive']['list_reply']['title'];
                    } else if ($c['type'] != 'text') {
                        $url = $this->getwhatsappMediaURL($c[$c['type']]['id'], $request->type);
                        $w->body = $url;
                    } else
                        $w->body = $c['text']['body'];
                    //$w->body = json_encode($dd);
                    $w->fromMe = 0;
                    $w->id = $c['id'];
                    $w->isForwarded = 0;
                    $w->time = strtotime(date('Y-m-d H:i:s'));
                    $w->chatId = $c['from'];
                    $w->type = $c['type'] == "text" ? 'chat' : $c['type'];

                    $w->senderName = $d['value']['contacts'][0]['profile']['name'];
                    $w->quotedMsgId = $c['id'];;
                    $w->chatName = $c['from'];
                    $w->instance_name = $request->type;

                    $w->save();


                }
            }
            return $request->hub_challenge;
        }
        //return $request->hub_challenge;
        return response($request->hub_challenge, 200);
    }

    function getwhatsappMediaURL($id, $instanceId = "EMC")
    {

        if ($instanceId == "EMC") {
            $version = env('emc_version', 0);
            $phoneID = env('emc_phoneID', 0);
            $tokenWHGraph = env('emc_token', 0);
        }
        $url = "https://graph.facebook.com/$version/$id";
        $client = new Client(['headers' => ['Content-Type' => 'application/json', 'Authorization' => "Bearer $tokenWHGraph"]]);
        $response = $client->get(
            $url
        );


        $d = json_decode($response->getBody(), true);
        $url = $d["url"];
        $ext = substr($d["mime_type"], strpos($d["mime_type"], "/") + 1);
        // return $url;
        if ($url) {
            $path = public_path('attachments'); // upload directory

            $message = '';
            $client = new Client(['headers' => ['Authorization' => "Bearer $tokenWHGraph"]]);
            $filename = time() . Str::random(25) . '.' . $ext;
            $dest = $path . DIRECTORY_SEPARATOR . $filename;
            $resource = fopen($dest, 'w');

            // $stream = \GuzzleHttp\Psr7\Utils::streamFor($resource);
            //$client->request('GET', $url, ['save_to' => $stream]);

            $client->request('GET', $url, ['sink' => $resource]);
            // if($request->hasFile('image'))
            //{


            //Storage::disk('excel')->put($filename, file_get_contents($url));


            $link = "https://elite.developon.co/attachments/" . $filename;

            return $link;
        }
        return $url;


    }

    public
    function testwhatsapp(Request $request)
    {
        try {
            $message = "";
            if (request()->token)
                $token = request()->token;
            if (request()->instanceId)
                $instanceId = request()->instanceId;

            //return  $this->getoptions('Clinic','972599528821@c.us');

            // $options = $this->getOptions('Clinic', '972599528821@c.us');
            return $this->sendWhatsapp($request->mobile, $request->body, $request->type, $token, $instanceId, 0, $request->type2, $request->link);


        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

//////////////////////////////
    public
    function webhooktawk(Request $request)
    {
        if ($request->hub_token == 'MabeetPs')
            return $request->MabeetPs;

        else
            return $request->MabeetPs;
    }

    public function verifySignature($body, $signature)
    {
        $digest = hash_hmac('sha1', $body, '721e1459ac62c847a840844225df2ec5b19912c9349ff655da2bab8789988ea1239911e54be3cda08933a2a9d9c426dc');
        return $signature === $digest;
    }

    public
    function webhooktawk2(Request $request)
    {

        /*       if (!$this->verifySignature(file_get_contents('php://input'), $_SERVER['HTTP_X_TAWK_SIGNATURE'])) {
                   return response("bye", 400);
               }*/
        try {
            //  DB::beginTransaction();

            $dd = $request->all();
            $wtext = '';
            // return $request->all();
            if (isset($dd["chat"]["messages"]) && count($dd["chat"]["messages"]) > 0) {
                for ($i = 0; $i < count($dd["chat"]["messages"]); $i++) {
                    $last = TawkHistory::where('chatId', $dd["chat"]["id"])->where('message_time', $dd["chat"]["messages"][$i]["time"])->get()->first();
                    if (!$last) {
                        $text = isset($dd["chat"]["messages"][$i]["msg"]) ? $dd["chat"]["messages"][$i]["msg"] : '';

                        $tawkHistory = new TawkHistory();
                        $tawkHistory->chatId = isset($dd["chatId"]) ? $dd["chatId"] : '';
                        $tawkHistory->time = isset($dd["time"]) ? $dd["time"] : '';
                        $tawkHistory->event = isset($dd["property"]["id"]) ? $dd["property"]["id"] : '';
                        $tawkHistory->msg_type = isset($dd["msg_type"]) ? $dd["msg_type"] : '';

                        $tawkHistory->visit_country = isset($dd["chat"]["visitor"]["country"]) ? $dd["chat"]["visitor"]["country"] : '';
                        $tawkHistory->visit_name = isset($dd["chat"]["visitor"]["name"]) ? $dd["chat"]["visitor"]["name"] : '';
                        $tawkHistory->visit_id = isset($dd["chat"]["visitor"]["city"]) ? $dd["chat"]["visitor"]["city"] : '';
                        $tawkHistory->visit_email = isset($dd["chat"]["visitor"]["email"]) ? $dd["chat"]["visitor"]["email"] : '';

                        $tawkHistory->sender_type = isset($dd["chat"]["messages"][$i]["sender"]["t"]) ? $dd["chat"]["messages"][$i]["sender"]["t"] : '';
                        $tawkHistory->message_time = isset($dd["chat"]["messages"][$i]["time"]) ? $dd["chat"]["messages"][$i]["time"] : '';
                        $tawkHistory->message_msg = $text;
                        $tawkHistory->att_type = isset($dd["chat"]["messages"][$i]["type"]) ? $dd["chat"]["messages"][$i]["type"] : '';
                        if (strlen($text) > 2) {
                            $tawkHistory->save();
                            if ($tawkHistory->sender_type == "v") {
                                $msg = "*Visitor: " . $text . ". ";
                                $wtext .= $msg;
                            }
                        }

                    }
                }

                try {
                    if (strlen($wtext) > 2) {
                        $this->sendWhatsapp('972599528821', $wtext);
                      $this->sendWhatsapp('970592413400', $wtext);
                       $this->sendWhatsapp('972597700004', $wtext);
                    }
                } catch (Exception $ex) {

                }

            } else {

                $tawkHistory = new TawkHistory();
                $text = '';
                $tawkHistory->time = $dd["time"];
                $tawkHistory->event = $dd["property"]["id"];
                // $tawkHistory->msg_type = $dd["msg_type"];
                if (isset($dd["chat"])) {
                    $tawkHistory->chatId = isset($dd["chat"]["id"]) ? $dd["chat"]["id"] : $tawkHistory->chatId;
                    $tawkHistory->visit_country = isset($dd["chat"]["visitor"]["country"]) ? $dd["chat"]["visitor"]["country"] : '';
                    $tawkHistory->visit_name = isset($dd["chat"]["visitor"]["name"]) ? $dd["chat"]["visitor"]["name"] : '';
                    $tawkHistory->visit_id = isset($dd["chat"]["visitor"]["city"]) ? $dd["chat"]["visitor"]["city"] : '';
                    $tawkHistory->visit_email = isset($dd["chat"]["visitor"]["email"]) ? $dd["chat"]["visitor"]["email"] : '';
                }
                if (isset($dd["visitor"])) {
                    $tawkHistory->chatId = isset($dd["chatId"]) ? $dd["chatId"] : $tawkHistory->chatId;
                    $tawkHistory->visit_country = isset($dd["visitor"]["country"]) ? $dd["visitor"]["country"] : '';
                    $tawkHistory->visit_name = isset($dd["visitor"]["name"]) ? $dd["visitor"]["name"] : '';
                    $tawkHistory->visit_id = isset($dd["visitor"]["city"]) ? $dd["visitor"]["city"] : '';
                    $tawkHistory->visit_email = isset($dd["visitor"]["email"]) ? $dd["visitor"]["email"] : '';
                }
                if (isset($dd["message"])) {
                    $tawkHistory->sender_type = isset($dd["message"]["sender"]["type"]) ? $dd["message"]["sender"]["type"] : '';
                    $tawkHistory->message_time = isset($dd["message"]["time"]) ? $dd["message"]["time"] : '';
                    $text = isset($dd["message"]["text"]) ? $dd["message"]["text"] : '';
                    $tawkHistory->att_type = isset($dd["message"]["type"]) ? $dd["message"]["type"] : '';

                }
                if (strlen($text) > 2) {
                    $tawkHistory->message_msg = $text;
                    $tawkHistory->save();
                }
                try {
                    if (strlen($text) > 2) {
                        $this->sendWhatsapp('972599528821', "New Chat on Mabeet " . $text);
                        $this->sendWhatsapp('970592413400', "New Chat on Mabeet " . $text);
                       $this->sendWhatsapp('972597700004', "New Chat on Mabeet " . $text);

                    }

                } catch (Exception $ex) {

                }
                //   DB::commit();
            }
        } catch (Exception $ex) {
            //  DB::rollBack();
            $tawkHistory = new TawkHistory();
            $tawkHistory->message_msg = $ex->getMessage();
            $tawkHistory->save();

        }


        /*$tawkHistory->content= $dd["content"];
        $tawkHistory->content_file= $dd["content_file"];
        $tawkHistory->content_file_url= $dd["content_file_url"];
        $tawkHistory->content_file_name= $dd["content_file_name"];
        $tawkHistory->att_content_file_mimeType= $dd["att_content_file_mimeType"];*/


        return response("hi", 200);
    }

/// //////////////////////////
    public
    function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


}

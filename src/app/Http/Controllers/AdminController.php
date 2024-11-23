<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\NewReview;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin/admin');
    }

    public function showCreateManagerForm()
    {
        $restaurants = Restaurant::all();
        return view('admin.create-manager', compact('restaurants'));
    }

    public function createManager(Request $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'manager',
        ]);

        $restaurantId = $request->input('restaurant_id');
        $restaurant = Restaurant::find($restaurantId);
        if ($restaurant) {
            $restaurant->manager_id = $user->id;
            $restaurant->save();
        }

        return redirect()->route('admin.done');
    }

    public function done()
    {
        return view('admin.done-admin');
    }

    public function showSendEmailForm()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.send-email', compact('users'));
    }

    public function sendEmail(Request $request)
    {
        $recipientsIds = $request->input('recipients');
        $subject = $request->input('subject');
        $message = $request->input('message');

        $recipients = User::whereIn('id', $recipientsIds)->get();

        foreach ($recipients as $recipient) {
            Mail::raw($message, function ($mail) use ($recipient, $subject) {
                $mail->to($recipient->email)
                    ->subject($subject);
            });
        }

        return redirect()->route('admin.sent');
    }

    public function sent()
    {
        return view('admin.sent');
    }

    public function destroyReview($review_id)
    {
        $review = NewReview::findOrFail($review_id);
        $review->delete();

        return redirect()->route('reviews.all', ['restaurant_id' => $review->restaurant_id])
                        ->with('success', '口コミが削除されました');
    }

    public function showCsvImportForm()
    {
        return view('admin.csv-import');
    }

    public function importCsv(Request $request)
    {
        // バリデーション
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        // アップロードされたCSVファイルを取得
        $file = $request->file('csv_file');

        // ファイルを開く
        if (($handle = fopen($file->getRealPath(), 'r')) !== false) {
            $header = null;
            $data = [];

            // 1行ずつ読み込んで処理
            while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                if (!$header) {
                    // 最初の行をヘッダーとして使用
                    $header = $row;
                } else {
                    // CSVのデータを配列に格納
                    $data[] = array_combine($header, $row);
                }
            }

            fclose($handle);

            foreach ($data as $row) {
                if (strlen($row['店舗名']) > 50 || !in_array($row['地域'], ['東京都', '大阪府', '福岡県']) ||
                    !in_array($row['ジャンル'], ['寿司', '焼肉', 'イタリアン', '居酒屋', 'ラーメン']) ||
                    strlen($row['店舗概要']) > 400 ||
                    !filter_var($row['画像URL'], FILTER_VALIDATE_URL)) {
                    return redirect()->route('admin.csvImportForm')->with('error', 'CSVに不正なデータが含まれています。');
                }

                $validExtensions = ['jpeg', 'jpg', 'png'];
                $fileExtension = pathinfo($row['画像URL'], PATHINFO_EXTENSION);

                if (!in_array(strtolower($fileExtension), $validExtensions)) {
                    return redirect()->route('admin.csvImportForm')->with('error', 'jpegまたはpngのみアップロード可能です！');
                }

                $area_id = \App\Models\Area::where('area_name', $row['地域'])->first()->id ?? null;
                $genre_id = \App\Models\Genre::where('genre_name', $row['ジャンル'])->first()->id ?? null;

                if (!$area_id || !$genre_id) {
                    return redirect()->route('admin.csvImportForm')->with('error', 'CSVに不正な地域またはジャンルが含まれています。');
                }


                Restaurant::create([
                    'manager_id' => 1,
                    'area_id' => $area_id,
                    'genre_id' => $genre_id,
                    'restaurant_name' => $row['店舗名'],
                    'description' => $row['店舗概要'],
                    'photo_url' => $row['画像URL'],
                ]);
            }

            return redirect()->route('admin.csvImportForm')->with('success', '店舗情報がインポートされました');
        }

        return redirect()->route('admin.csvImportForm')->with('error', 'ファイルの読み込みに失敗しました');
    }

}


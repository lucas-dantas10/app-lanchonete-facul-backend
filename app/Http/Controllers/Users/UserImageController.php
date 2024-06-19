<?php 

namespace App\Http\Controllers\Users;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserImageController
{
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $user = Auth::user();

        if ($user->image_url) {
            Storage::delete($user->image_url);
        }

        $path = $request->file('image')->store('public/images');

        $path = asset(str_replace('public/','storage/', $path));

        $user->image_url = $path;
        $user->save();

        return new JsonResponse(['message' => 'Imagem atualizada com sucesso!', 'image' => $path], 200);
    }
}

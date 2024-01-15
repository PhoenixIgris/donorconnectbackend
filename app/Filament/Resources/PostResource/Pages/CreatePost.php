<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class CreatePost extends CreateRecord
{
  protected static string $resource = PostResource::class;

  // public function create(bool $another = false): void
  // {

  //   $data =  $this->form->model($this->getRecord());
  //   $images = $data->getLivewire()->data['image'];
  //   $split = explode("/", $images[array_key_first($images)]->getRealPath());
  //   $localImagePath = $split[count($split) - 1];
  //   $image = Storage::get("livewire-tmp/" . $localImagePath);
  //   $firebase = (new Factory)
  //     ->withServiceAccount(base_path() . "/firebase_credential.json");
  //   $storage = $firebase->createStorage();
  //   $bucket = $storage->getBucket();

  //   // Define a unique path for the image in Firebase Storage
  //   $firebaseStoragePath = 'profile_images/' . uniqid() . '-' . "sachita." . explode(".", $localImagePath)[count(explode(".", $localImagePath)) - 1];
  //   $bucket->upload($image, ['name' => $firebaseStoragePath]);

  //   // Optionally, you can set custom metadata for the uploaded image
  //   // $metadata = ['contentType' => 'image/jpeg'];
  //   // $bucket->object($firebaseStoragePath)->updateMetadata($metadata);

  //   // Get the public URL of the uploaded image
  //   $publicUrl = $bucket->object($firebaseStoragePath)->signedUrl(time() + 3600);
  //   $this->data['image'] = $publicUrl;
  // }
}

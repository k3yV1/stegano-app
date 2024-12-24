<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Intervention\Image\Laravel\Facades\Image;
use Random\RandomException;

class SteganographyController extends Controller
{
    public function encodeImage(Request $request): JsonResponse
    {
        try {
            $encodeData = $request->input('encodeData', []);
            $fileData = $encodeData['file'];
            $filename = $fileData['fileName'];
            $fileContent = base64_decode($fileData['fileContent']);
            $message = $encodeData['message'];
            $key = config('app.encryption_key');

            $encryptedMessage = $this->encryptMessage($message, $key);

            $imageContent = $this->hideMessage($fileContent, $message);
            $encodedImage = $this->hideMessage($imageContent, $encryptedMessage);


            $processedFilename = 'processed_' . $filename;
            $encodedImagePath = $this->saveEncodedImage($encodedImage, $processedFilename);

            return response()->json([
                'status' => 'success',
                'hidden_message' => $encryptedMessage,
                'message' => 'Message processed successfully.',
                'file_url' => asset('storage/' . $encodedImagePath),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function decodeImage(Request $request): JsonResponse
    {
        try {
            $decodeData = $request->input('decodeData', []);
            Log::info("decodeData: ", $decodeData);

            // Проверка наличия данных изображения
            if (!isset($decodeData['imageData'])) {
                throw new \Exception("Image data is missing.");
            }

            $imageData = $decodeData['imageData'];
            $imageContent = base64_decode($imageData);

            if ($imageContent === false) {
                throw new \Exception("Unable to decode image content.");
            }

            // Извлекаем скрытое сообщение из изображения
            $hiddenMessage = $this->extractMessage($imageContent);
            if (empty($hiddenMessage)) {
                throw new \Exception("Hidden message extraction failed.");
            }

            // Извлекаем зашифрованное сообщение и декодируем его
            list($iv, $encryptedMessage) = explode('::', base64_decode($hiddenMessage), 2);

            if (empty($iv) || empty($encryptedMessage)) {
                throw new \Exception("Invalid IV or encrypted message format.");
            }

            $key = config('app.encryption_key');
            if (empty($key)) {
                throw new \Exception("Encryption key not found in config.");
            }

            $decryptedMessage = $this->decryptMessage($encryptedMessage, $iv, $key);

            return response()->json([
                'status' => 'success',
                'message' => 'Message decoded successfully.',
                'decoded_message' => $decryptedMessage,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    private function saveEncodedImage($encodedImage, $filename): string
    {
        // Сохраняем изображение в папку storage/app/public/encode
        $path = Storage::disk('public')->put('encode/' . $filename, $encodedImage);
        return 'encode/' . $filename;  // Возвращаем относительный путь для публичного доступа
    }

    /**
     * @throws RandomException
     */
    private function encryptMessage($message, $key): string
    {
        $cipher = 'AES-256-CBC';
        $iv = random_bytes(openssl_cipher_iv_length($cipher));
        $encrypted = openssl_encrypt($message, $cipher, $key, 0, $iv);
        return base64_encode($iv . '::' . $encrypted);
    }

    private function decryptMessage($encryptedMessage, $iv, $key): string
    {
        $cipher = 'AES-256-CBC';
        return openssl_decrypt($encryptedMessage, $cipher, $key, 0, $iv);
    }

    private function hideMessage($imageContent, $message): string
    {
        $image = Image::read($imageContent);
        $hiddenMessage = 'HIDDEN_MSG:' . $message;

        $image->text($hiddenMessage, 10, 10, function ($font) {
            $font->size(24);
            $font->color('#fd0');
            $font->align('left');
            $font->valign('top');
        });

        return (string)$image->encode();
    }

    private function extractMessage($imageContent): string
    {
        $image = Image::read($imageContent);

        $tempImagePath = storage_path('app/public/temp_image.png');
        $image->save($tempImagePath);

        $tesseractOutput = shell_exec("tesseract $tempImagePath -");

        return trim($tesseractOutput);
    }
}

//    private function extractMessage($imageContent): string
//    {
//        // Загружаем изображение
//        $image = Image::read($imageContent);
//        $message = '';
//
//        // Преобразуем изображение в массив пикселей
//        $width = $image->width();
//        $height = $image->height();
//
//        // Читаем пиксели по одному и извлекаем скрытые биты
//        for ($y = 0; $y < $height; $y++) {
//            for ($x = 0; $x < $width; $x++) {
//                $pixel = $image->pickColor($x, $y);
//
//                // Извлекаем последний бит каждого компонента цвета (RGB)
//                foreach ($pixel as $value) {
//                    $message .= (string)($value & 1); // Последний бит
//                }
//            }
//        }
//
//        // Преобразуем строку битов в текстовое сообщение
//        return $this->binToString($message);
//    }

//    private function binToString($bin): string
//    {
//        $text = '';
//        for ($i = 0; $i < strlen($bin); $i += 8) {
//            $byte = substr($bin, $i, 8);
//            $text .= chr(bindec($byte)); // Преобразуем каждый 8-битный блок в символ
//        }
//        return $text;
//    }
//}


//namespace App\Http\Controllers;
//
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Storage;
//use Illuminate\Http\JsonResponse;
//use Intervention\Image\Laravel\Facades\Image;
//use Intervention\Image\Colors\Rgb as Rgb;
//use Random\RandomException;
//
//class SteganographyController extends Controller
//{
//    public function encodeImage(Request $request): JsonResponse
//    {
//        try {
//            $encodeData = $request->input('encodeData', []);
//            $fileData = $encodeData['file'];
//            $filename = $fileData['fileName'];
//            $fileContent = base64_decode($fileData['fileContent']);
//            $message = $encodeData['message'];
//            $key = config('app.encryption_key');
//
//            // Шифруем сообщение перед вставкой в изображение
//            $encryptedMessage = $this->encryptMessage($message, $key);
//
//            // Преобразуем зашифрованное сообщение в бинарный формат
//            $binaryMessage = $this->stringToBinary($encryptedMessage);
//
//            // Вставляем скрытое сообщение в изображение
//            $encodedImage = $this->hideMessage($fileContent, $binaryMessage);
//
//            // Сохраняем изображение с зашифрованным сообщением
//            $processedFilename = 'processed_' . $filename;
//            $encodedImagePath = $this->saveEncodedImage($encodedImage, $processedFilename);
//
//            return response()->json([
//                'status' => 'success',
//                'message' => 'Message processed successfully.',
//                'file_url' => asset('storage/' . $encodedImagePath),
//            ]);
//
//        } catch (\Exception $e) {
//            return response()->json([
//                'status' => 'error',
//                'message' => 'An error occurred: ' . $e->getMessage(),
//            ], 500);
//        }
//    }
//
//    public function decodeImage(Request $request): JsonResponse
//    {
//        try {
//            $imageData = $request->input('imageData');
//            $imageContent = base64_decode($imageData);
//
//            // Извлекаем скрытое сообщение в бинарном формате из изображения
//            $binaryMessage = $this->extractMessage($imageContent);
//
//            // Преобразуем бинарное сообщение обратно в строку
//            $encryptedMessage = $this->binaryToString($binaryMessage);
//
//            // Декодируем зашифрованное сообщение
//            list($iv, $encryptedMessage) = explode('::', base64_decode($encryptedMessage), 2);
//            $key = config('app.encryption_key');
//            $decryptedMessage = $this->decryptMessage($encryptedMessage, $iv, $key);
//
//            return response()->json([
//                'status' => 'success',
//                'message' => 'Message decoded successfully.',
//                'decoded_message' => $decryptedMessage,
//            ]);
//        } catch (\Exception $e) {
//            return response()->json([
//                'status' => 'error',
//                'message' => 'An error occurred: ' . $e->getMessage(),
//            ], 500);
//        }
//    }
//
//    private function saveEncodedImage($encodedImage, $filename): string
//    {
//        // Сохраняем изображение в папку storage/app/public/encode
//        $path = Storage::disk('public')->put('encode/' . $filename, $encodedImage);
//        return 'encode/' . $filename;  // Возвращаем относительный путь для публичного доступа
//    }
//
//    /**
//     * @throws RandomException
//     */
//    private function encryptMessage($message, $key): string
//    {
//        $cipher = 'AES-256-CBC';
//        $iv = random_bytes(openssl_cipher_iv_length($cipher));
//        $encrypted = openssl_encrypt($message, $cipher, $key, 0, $iv);
//        return base64_encode($iv . '::' . $encrypted);
//    }
//
//    private function decryptMessage($encryptedMessage, $iv, $key): string
//    {
//        $cipher = 'AES-256-CBC';
//        return openssl_decrypt($encryptedMessage, $cipher, $key, 0, $iv);
//    }
//
//    private function stringToBinary($string): string
//    {
//        $binary = '';
//        for ($i = 0; $i < strlen($string); $i++) {
//            $binary .= sprintf('%08b', ord($string[$i]));
//        }
//        return $binary;
//    }
//
//    private function binaryToString($binary): string
//    {
//        $string = '';
//        for ($i = 0; $i < strlen($binary); $i += 8) {
//            $byte = substr($binary, $i, 8);
//            $string .= chr(bindec($byte));
//        }
//        return $string;
//    }
//
//    private function hideMessage($imageContent, $binaryMessage): string
//    {
//        $image = Image::read($imageContent);
//        $width = $image->width();
//        $height = $image->height();
//
//        $binaryMessageIndex = 0;
//        $messageLength = strlen($binaryMessage);
//
//        // Преобразуем изображение в массив пикселей и изменяем последние биты пикселей
//        for ($y = 0; $y < $height; $y++) {
//            for ($x = 0; $x < $width; $x++) {
//                $pixel = $image->pickColor($x, $y); // Получаем цвет пикселя
//                $newPixel = [];
//
//                // Убедимся, что пиксель содержит RGB компоненты
//                if ($pixel instanceof Rgb\Color) {
//                    // Получаем значения компонентов RGB
//                    $r = $pixel->red();
//                    $g = $pixel->green();
//                    $b = $pixel->blue();
//
//                    // Обрабатываем каждый цветовой компонент (RGB)
//                    $components = [$r, $g, $b];
//                    foreach ($components as $index => $colorValue) {
//                        if ($binaryMessageIndex < $messageLength) {
//                            // Заменяем последний бит на бит из сообщения
//                            $newPixel[$index] = ($colorValue & 0xFE) | (int)$binaryMessage[$binaryMessageIndex];
//                            $binaryMessageIndex++;
//                        } else {
//                            // Если сообщение закончилось, оставляем пиксель неизменным
//                            $newPixel[$index] = $colorValue;
//                        }
//                    }
//
//                    // Заменяем пиксель в изображении
//                    $image->drawPixel($x, $y, $newPixel[0], $newPixel[1], $newPixel[2]);
//
//                    if ($binaryMessageIndex >= $messageLength) {
//                        break 2; // Прерываем внешний цикл, если все данные вставлены
//                    }
//                }
//            }
//        }
//
//        // Возвращаем строковое представление закодированного изображения
//        return (string)$image->encode();
//    }


//    private function hideMessage($imageContent, $binaryMessage): string
//    {
//        $image = Image::read($imageContent);
//        $width = $image->width();
//        $height = $image->height();
//
//        $binaryMessageIndex = 0;
//        $messageLength = strlen($binaryMessage);
//
//        // Преобразуем изображение в массив пикселей и изменяем последние биты пикселей
//        for ($y = 0; $y < $height; $y++) {
//            for ($x = 0; $x < $width; $x++) {
//                $pixel = $image->pickColor($x, $y);
//                $newPixel = [];
//
//                // Обрабатываем каждый цветовой компонент (RGB) пикселя
//                foreach ($pixel as $colorValue) {
//                    if ($binaryMessageIndex < $messageLength) {
//                        // Заменяем последний бит на бит из сообщения
//                        $newPixel[] = ($colorValue & 0xFE) | (int)$binaryMessage[$binaryMessageIndex];
//                        $binaryMessageIndex++;
//                    } else {
//                        // Если сообщение закончилось, оставляем пиксель неизменным
//                        $newPixel[] = $colorValue;
//                    }
//                }
//
//                // Заменяем цвет пикселя в изображении
//                $image->drawPixel([$newPixel[0], $newPixel[1], $newPixel[2]], $x, $y);
//                if ($binaryMessageIndex >= $messageLength) {
//                    break 2; // Прерываем внешний цикл, если все данные вставлены
//                }
//            }
//        }
//
//        return (string)$image->encode();
//    }

//    private function extractMessage($imageContent): string
//    {
//        $image = Image::read($imageContent);
//        $width = $image->width();
//        $height = $image->height();
//
//        $binaryMessage = '';
//
//        // Извлекаем скрытое сообщение, читая последние биты каждого пикселя
//        for ($y = 0; $y < $height; $y++) {
//            for ($x = 0; $x < $width; $x++) {
//                $pixel = $image->pickColor($x, $y);
//
//                foreach ($pixel as $colorValue) {
//                    $binaryMessage .= (string)($colorValue & 1); // Извлекаем последний бит
//                }
//            }
//        }
//
//        return $binaryMessage;
//    }
// }

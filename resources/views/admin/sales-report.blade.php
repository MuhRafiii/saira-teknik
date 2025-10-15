@extends('layouts.admin')

@section('title', 'Sales Report')
@section('header', 'Sales Report')

@section('content')
<div id="page-content" class="bg-white p-4 sm:p-6 rounded shadow w-full">

    <form method="GET" action="{{ route('admin.sales-report.index') }}" class="flex flex-col sm:flex-row sm:items-end text-sm gap-3 mb-6">
        <div class="flex flex-col">
            <label for="start_date">Start Date</label>
            <input id="start_date" type="date" name="start_date" value="{{ $startDate }}" class="border p-2 rounded text-sm">
        </div>

        <div class="flex flex-col">
            <label for="end_date">End Date</label>
            <input id="end_date" type="date" name="end_date" value="{{ $endDate }}" class="border p-2 rounded text-sm">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
            Filter
        </button>
    </form>

    <h2 class="font-semibold mb-3">Period: {{ $startDateFormatted }} - {{ $endDateFormatted }}</h2>

    <div class="flex justify-end gap-3 mb-3">
        <a href="{{ route('admin.sales-report.export-excel', request()->query()) }}" class="flex gap-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition text-sm">
            <img
                class="w-5"
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAAFN0lEQVR4nO2dW6gVVRjHPy2LblaKVGIQXaHALIpesocQKoskKCqiB1/SoFcxouJ0Iim6He0mBPZiQRfspYtW9FJBFGiQRT1EdIOyrE4mFnr8xeJMtDvON7POmXX5Zvb8YD/ttfb3/77/nrVnZq01W6Snp6enp6enp6enp6chwHnA48BO4E/ysAt4H1gDHC/DAHAE8ARwAFv8AtwkQ1D8t7HLQeAe6SrFN78NjEhHx3xrw87wmACM0T4elK4AfIYtRnzbSRcA9mAImdS0dmiOBIwh/+kaDhMwhvxfW/dNwBhyqL5um4AxpFxjd03AGKLr7KYJGEOqtXbPBIwh9Xq7ZQLGED/N3TEBY4i/7m6YgDFketrbbwLGkOnrb7cJGENmlkN7TcAYMvM82mkCxpBmufjeyrYzvYkxpHk+I55zzDeLBTCGhMnJZzj6FZgXIl5TsdY4LlBePkfCmhCxmgq1xnUBc6sz4b1QsZqItMYXIYeGGhN2hYrTRKBFvgNuAOZGNuFgiM9vKm6okdww5EhuGHIkNww5kpsIOf2sncsDRwO7a/rvA05W+t8bWqzkhjisrYjnNn9U8aTSbz4wHlqo5IZ4myrmKvHOBCaUfm6V9hlKv0diCJXcEI+7K2K+pfTZrLRfCOyNIVJyQzx+B05UYq5Q+lygtH82lkjJDXG5T4l5GPD1lLavKW3PAvbHEii5IS7j2n0d4K4pbZcq7V6MKVByQ3zWKXEXFKecjg+VNosrfrCDILkhPntcsZXYm4s2K5T334gtTnJDGh5WYl8D/AbMKXlvaQphkpsUSTI51CwsiX0UsFHR9UEKYZIb0jGmxF+gHBlJkNykSpTJo2CRh57ZwI5UotJUuTrhlDzloeeWlILSVLk64ZT8DZxSo+fTlILSVVpPOCWfA4fX6HkopaB0ldYTTslyDz3zilPTEHwDbACuAM4BjhFrkI53p6Hpzoaxvgduc/ecxDqkYQJYUhJ7EXCpMnP2wwxjvQocK22BNDynxF4FjFa8N13ck19mS5sgPnu18//iaversqHC/VgDX07zm9+u4juIz/1K3MsG2tyotHGr43xX0rVn2BmEuPxUMTc8eKfzE2BWSZtZ7la1R5yV0laIyyol5vnFJolBliltl3mcato/29GIWPyd2kUX8EJJ+20VGque6LjBI8dTgVeAP4rXFnddIB03YLkS7/SKhwQuUfpcVHLE/MuVHsUvWwy22+fmYHSIwzsV8Z6u6Pd8RT9tbvjsmvzcN1/jJckNiS66HMBJA/PAZbjVD6dJCa7QyuqIyi1NxZCjMS65ITybKmKt8+i/vqL/xqmNm+YnuSE8o8V9mLKXW6xVh3tg+Gql/yE7XZrml6bKDQRaRxrml6bKDQRaRxrml6bKDQQaZaK4kl7dNL80VW4g0CAvuyXuofKLW90AAg2xz03Yh84vTlUDCjTCX8DlMfILX9HAAo2wMlZ+YasZQaABXo+ZX7hKRhJogAtj5heukpEEZmZ77PzCVLGZwKqbVbkZ9dB/azF3HHIjx/5ifepVKQxwEydWubZG+/WR47t5i0tiG/AYdrm4RvvWBBo2xTbgXMN/Y7W4RvtHCTRsiWpAkch6bHJ1jW6f+YWm3J7CgDkVu9dzckeNbreEcXvE+G8mW3FRmDAWc1P0DNjqoXt+pB0129wetiTFL/lNeLTYKJH7P8YOaI+uiWxCnuK3GeAE4OMAxXdDcV/8TCb0xc9oQl/8jCb0xc9oQl/8jCb0xc9oQl98SYTbJAI8A/wIfAs8ABwZ4sP/AYVSf3bf6oy3AAAAAElFTkSuQmCC"
                alt="export-excel">
            Download Excel
        </a>
        <a href="{{ route('admin.sales-report.export-pdf', request()->query()) }}" class="flex gap-2 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition text-sm">
            <img
                class="w-5"
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFMElEQVR4nO2cSYgdRRjHy4REQRQ1bslBEU0UjBrEmwsugYgLKiOoicngwQU1Q0BJclPwEEXRg4bgRUXBi3gQUQ+KENSDy0ES0JziBm4IYtyHzPykTMF701PdXa+7uvv7uut3GTLzpuv/fb/Je91V1W1MIpFoAPQxC9xs+go6mQVuMX0Evcz2Ugq6me2dFPSxI/Pvw8Dtpi+gDHMks0/KHaYPoAwzyt1PKSjDLMzePykowyzO75Oy0WgFZRh/Df2RgjJMfh0+KZuMNlCGKa5FvxSUYcrr8Um502gBZZiwmvRKQRkmvC6dUlCGmaw2fVJQhpm8Pp+UzUYqKMNUq1GPFJRhqtepQwrKMPVq9UnZYiSBMkz9emVLQRkmTs0+KdNGAijDxKs7K2VOhBSUYeLWLk8KyjDx65clBWWYZnqQlTIP3NvEWCFhVGGa64NPyn1NjVcURBWm2V48mhlursnx8kIkCkhChJGECCMJEUYSIowkRBhDEvI38AhwNnAMsBp4yl0pi2EoQuaA9Tl5tiKIoQh5tSDPEmA/QhiKkOmSTI8hhPZMjIrvgitKMm1GCO2ZGBUvUchGhNCeiVHxXXBbSaYtCKE9E6Piu+DxkkwzCKE9E6Piu+DjkkzPIYT2TIyK74LDwKqCTO8hhCFdqW/PyXMU8BNCGJKQL23zPXnOQxBDEoLvqT52cwGCGJqQTz157ASjGIYm5Fs7d5XJsxL4FSEMTciunEx3I4ShCVlbkOt1BDAkIZ+U5DoBOEjHtGdiVHhXPJjJsQ44OvO9tV1/ngxFyD/AyZkc7wB7PPmucq/vhFZluIK74MVMhtVja+mL7mYCNgB/eo7zI3AA+AzYB3wfO2irMlyxXXBRJsPTYz/7F7jGk/MytyliCliTfXsbe93pwAPADzGCmrahfd7NjH+s53PiG2BFzbrs9cxXdcPWbnCF4G1zZc41x3du2n09sCxSbdN1w8bIMWnoNtmbs1x7iW+iMUJtp8UuIHZGX+g2ubpixuXZKZbA3zszdgFV8k8aui3enjDXWcD9wFvuDOsj4PwJjxF9bd40Dc2z370tLS3Jscz+DwKeBL7IOZY9A3seOCdQqJ28jErU5ucEb4p99jHgZW819hQYeGbCVUK7BPw+8DBwudsffKL7ai8knwAOTRI2tD+NSCgaMAJ/uHv1lheMaZt3D/AhQgjtT2Mi8gasiZ2hXRlw5vMLwgjtTyMSigasiH0L2Ro43msIJLQ/UZsfMmAF5kMfWgzcilBC+xO1+SEDVuDZwHFWuMlAkYT2J2rzQwaswJqAMZYAbyKY0P5EF1A2YAWODxhjF8IJ7U90AWUDVuDakuPvRAGh/WlEQtGAFTjg26fLkRs596CEPgmx/GzXyIEL3JX3NremoYa+CVGPSUJkkYQIIwkRRuT+7E5CahKxP3uLZrqTkEAi9edgdgNgElKRCP35bdIl5iTkCDsj9GzGs/xwfW0ZAxVi2VajX9c5AePMRJExYCHzwF0VenUx8HvmWC9EkzFgIbi/8qkJ+rTK7a4c54NaZ1RJiHdb0YaAHh0HfJ75Xbtv+JSoMpKQ/7Gb8C4t6M9Sz+LaoaLb8ZKQ+tjd9+ty+rM781p7H8uNjchIQhZgN+qdm+nNdhbzUGMykpBF2K2nZ7i+THmekPpSozKSEC92X/ENwF+Nn1ElIZX5Gji1cRlJSBD2QvDCVmQkFjyj6xWPDPsZcpN7WaJN3F1a9haHcXa0GiKxEOAkt63J8nLmx4kucDf9vGH3lXUSIJEwQ+A/IT1HtYbtAdwAAAAASUVORK5CYII="
                alt="export-pdf">
            Download PDF
        </a>
    </div>

    <table class="w-full text-sm border border-gray-300">
        <thead class="bg-gray-100">
            <tr class="text-center">
                <th class="p-2 border">No</th>
                <th class="p-2 border w-1/2">Name</th>
                <th class="p-2 border">Price</th>
                <th class="p-2 border">Quantity</th>
                <th class="p-2 border">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $index => $item)
                <tr class="text-center">
                    <td class="p-2 border">{{ $index + 1 }}</td>
                    <td class="p-2 border text-left">{{ $item->product->name ?? '-' }}</td>
                    <td class="p-2 border">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="p-2 border">{{ $item->total_quantity }}</td>
                    <td class="p-2 border">Rp {{ number_format($item->price * $item->total_quantity, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="p-3 text-center text-gray-500">No data found</td></tr>
            @endforelse
        </tbody>
        <tfoot class="font-bold bg-gray-100">
            <tr class="text-center">
                <td colspan="4" class="p-2 border">TOTAL</td>
                <td class="p-2 border">Rp {{ number_format($totalIncome, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
@extends('layouts.customer')

@section('title', 'Home')

@section('content')
  <section class="pt-16 md:pt-24 pb-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-24">
      <!-- Hero Section -->
      <div class="text-center space-y-14">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-800">
          Welcome to {{ $company->name }}
        </h1>
        <div class="space-y-4">
            <a href="{{$company->gmaps}}" class="hidden sm:flex justify-center items-center gap-2 text-xs sm:text-sm text-gray-600 hover:underline">
                <img
                    class="w-5"
                    src="data:image/png;base64,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"
                    alt="address--v1">
                {{ $company->address }}
            </a>
            <div class="flex items-center justify-center gap-8">
                <a href="{{$company->gmaps}}" class="sm:hidden hover:scale-110 transition duration-300">
                    <img
                        class="w-10"
                        src="data:image/png;base64,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"
                        alt="address--v1">
                </a>
                <a href="https://wa.me/{{ $company->phone }}" class="flex items-center gap-2 hover:scale-110 transition duration-300 sm:hover:scale-none sm:transition-none">
                    <img
                        class="w-10 sm:w-5"
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAAOwElEQVR4nO1deYxbxRl3Kb2vP0pbqVIP9b+2Uqmqqq16yZT76JEQAuEKVwLlvlogpQRKm5aUI0DCTRAECIUkRA2EI4QFsrvJJrvveXe9nrFnvN4je9/3rq+pfrN+ieN63nu2n/284J/0SRFaxjPf9+ab75zxeCqooIIKKqigggoqqKCCCsoIdYHAl7VA+ESdsqs0wtfrlL2tUdakER7WKBvWKJ/TKY/O/5tFNMr9OmG7dMIe0WnoBi3IT/Nx/lW317FgUBWJfFoPhk/XCL9PI1zXCEvolItCSCMsCcFAgBoJLamv7/qs2+ssKwghPqZT/guN8sc1wkbSmdcYDAvW3iU6evtF//CIGJucEtOzc2IuGhXxeEIkk0lJ+PdcNCZm5ubk3/QPj4rO3gHBOrpEY6j1SIFQPqET/pyPsJNfFuLjno8q/H7/J30kfIlGWTCdQcG2TtEzMCQmpqZFIpkUhQICmpyeEb2DwyLUfjBjh7C2BsKu+UjtilAo9CksWqes3WCEn7eJ7v5B+QUXG9g9PYPDItDanq6m+jTCVn3oBaETdpxOeMBYOIl0iKGxcfmVuoGxickjdoVG+EEtyC70fNjQQMjXNcL/k8740YlJUS6AuoPqSzsn3mwKBr/j+TCggfLjdcp65KEaCkv97tYXbwXsxmYWMYQwrgX4Ms9CRVVV1dE6Yf+EGYgFhTu7RTQWE/liNDommseI2Nm7W7zYuU081faCWB9+WjwUfko8Edkk/9trPbuEb9QvBueG8/6dWDwuIl296Qf1ozCPPQsJhJAv6IS9gwX4gmHRNzSSMyP6ZgckQ++m94sz6y4R3j2LcqI/7Fsu7iBrxbbu18XBme6cf39gZEyawamzYR+cQs9CADxPnfJ6w7qBCWgXU/Fp+YVf13S7OG7P4pyZbkZ/9N0itna9LsZjE7bnMz07K1rCKWuJMFLvD3/TU85oaGn9lk5ZCBOGmQfnyA7GYuPimfaXxG/3XuAo07PRqbXLpNrqnx20NbdoLC5opOOwlRQKfc9Tjqin9BiNMmo4U9CllotLRMWmjlckU4rN+Ew6sWapeLLteTGbmLWcZyKRELyzyzgXunQS+ban7HQ+ZQcM5mPCVmgYaRTn119VcsZn0tL9K0TN0H5rISSTMrRxSB1ReoynHIB4CqKUhtqx+vLjybhUN07reG+BtCa4znI3xBOJdHW0r7aj4zNu89+jUXb3/IEbsdT5MA+varzNdWZ7FbRCv1H0zvZbngnGwaxR9lgZhBZYHKamlbXTPdMrzjtwpetM9loQTF4+GTFdy8zsXJqJGj7XFeY3NYW/hiAWJoFIoxmwoEX7LnaduV6bBGvMP05N1zQwMpo6D/iYK2ELjfBNmADvNHdyumZ6xOK6hcN8b4pO33ueYJOtpmszPGbEjkrK/IZg8NcIMWAbIryrwtDciFh24ArXmenNk5bUXWp6JsDgMGJHvgBfXLJEihFSNlM9iWRC3NB8h+tM9BZIl2jXi9nEnGnIIhUzai9JPkEPshUypNzabhrVhJPjNvO8DtGD/EnlOsEBI5SNpE4JIpyc48dGxtUxlcbRFtt2/vHVS8RqslZs7nxVRjRf6Nwqrmlc5TrTM8nMWRufmj6UWSvqLtBp6HzD4UqaOFrYtnYWdWrtMhk+zjbGCv0m15me6THPxNWm9qHMWoBdXTwBENaIHxkaHVdOZHPnNlsL+k31meLAiE85zt6heteZnklQqyogw2ck+otSbdEYYD/CD+DUV+n+ydiUNN9sLSaiXgyQEMmys6BOqllqmuw5lOgPhE5yXAA6Zesw+ME+dRgXkU07Czl7/0oRS1qHqnEmuM30THos8qxyvqi2SDlnzzp++GqU9WJwJCmyAaYaslB2FvHSwe3CbhrypJqlrjM9nU6rPVeZ1JmNRg/lkx09jGXMJ1XNoMI7/R/YXgTiQnaxJrjOdaZn0vbuN6wP4yBf5HjEs6tfrX7+5L/L1uQRE8oFLeNB1xmeSYjoWqohyh9yTAA65TUYFHWX2TAcHZFWjZ3JX+H7s8gVK/WbXWd6OsHHUe1iRIVToeomR5jv9/s/jxJwhJxVma5d/e/bnvz1TX/NWQBbu153nel21RAsRNQ/yarsUOgrBQtAI+znRqpRhbWhDbYnfpl2Y84C2N79husMz6S7yL3K+RqpS/QnFCwAnfCLMVhbt/rgzCXRglh7UulHF+ZZl5LMzrLO3n4jbXmdEzvgXxgMh4vK/Mw1v9s2pbamMgGHzW1mq2gkOiqyAb0MKQGsd0AA/FWz4BuSFrlOHA6WHbzRu9t1JptR01gg67xhrKSqJ3Y5ZgGpcr5VAzU5T/yihmst1VBwgosTqs9ynclmhCo+Vc445ZD5C98BlDVjMAzq5AFZN6yZCmBHz1uuM9iKEHjMBlSHGEkaJwQQwWCqkpN84zUoAUkk1QVcqNE5v768qyiebntRmapM+QJDBQtAJ3wAg6kKrjCJfBewo+dt013gHyNlV8CVTg+Hn1b6AilvOOrEDhjGYOhEzAbU6ee7gN/vWy4T92Z4KPyk64xW0XoLAaCPufAdkOpuQUVYNjzb8XJBi7jFf7fpgYywdblW021s32yqgqA9Ct8BhIcx2Oxc9vKTrV2vFTW6CGCXIIfgNsPthtVRqpPyA1od2AG81swMfX+gtuCFnFxzjohYOGcIfiEv6zbT0+mtvqqsc0XOJOUHNDqwA9g2M0eMTDBHFnNB/dWyQ8ZKCPlYRqta1khVZzdia5cQKjfLDztSMacRfj8GU/V5oVLAKUtlVcsaU9MUmIhNyr/Lx1JBmeS97BHZnOHEfFWZMfAq5Qc8WLAAdMJXYrD2nj4lU5y01x9WWBbpwKH9fOcWS0aiviiW/H/jYWBuSGxo3VhQZ85Z+y9Tzq+jJxWMo6ErHQtH04g6HH1PaH1JPMxMdE53KzNxYJBVuyp602DJ5NObhlSpVVoSPdIFCwA9srBnfZQrEzJv973nqAC8OSTugcaxFqnjDVV4Su0yEZowr2xOx1R8Stb85KJKVXEgtDKhaBlX7TjW2op2HEh0fHJa+SWdUL3EcSFstrkTDIQn22T7ExkPiXxwbeNfbM0LgoIaMytTRKuuxynolP/Dqibo5uY7HReAd88icR97VCZlSgGkS+3M6cbm1coxugeGjDrRexwTgI+Gf2nUhDpRlpIr3dS8OqcG63xh1894s+9d5RhGE18DZac4W5iVakfCjVWqnl+7hVn59m7V2GgnzRdo3LZzBvxu74ViWlGkezgPwIZwL5LHSaDOxUoNPVdgXMhrQ/fCjseh6TRe7d5paw6IfamAuqlUDGiDo8yXAgiGf2KnOLcU1w0srrtYxo/s1JfaAXK7aEey+l0UHsMRzAbwBHdjgEf1gdDPHBeAFAJh+/EDg6NjysW80rWj6ALwpqml5zu2KC0SO0B4w27VBZpIVBgeGze+/hZPsdBA2QXz7UnqwBk8z+UN15RMCN6UaoIFgwSP3cMa3jQCichJ2M1jZ/OqDYAn87VARbzyrL6+/hNGeHp4zJkWJa/DhEQ+YkXYiQiWZTINAqoaqJbX1+QiYKxJBQQqU+HnMAwWTzFhFGqhXV91FkAluMF8bxZCvOicA5fLeNWZdZfKnrRcx9ioyP3KnZRMHm7MIHylpzR3AuH+t1alAHb2vuM6470OES6PMovQolXXKEGBhii6AIwd0HqwRzkp1E26zTivA4Rdo6p+A1ApcuhmXsKOKzrzpQAoexE/ODA8quztKqZD5i0RYQ2ItpqBG0W4hG8qCfOFEEcZZSqqHDGd4K4zz+uAeYvAnhkM1YOihZLd0N5A+I/nD+C2ghv1ypWWHbjC8pbFielpgfA8Qs64Xt9TKmgBdhsEgNvMVcCh5TYTvXkS7rYYiaqdTKMRD5dTpfT+XSVjvhQA5VXzCfrs7jiS6uVeUOtV2PmPR56zzEfHYvE0k5PtLOn192hVMjJjqio5RCvtLPZy/WaxofWZsri0D2EI3MhrBXlf3OFLOep8Pt/nPKWELxA+Az+OfKcKuFVEVXLyAH9cfDC494hQQSwZk1FI5G9LzXgEDeEt20n24Ms3mK9Tzlx5FgUlFrJTZkAd+DK+aLTv3En+LUvMrS7BMwSBv7UTkXTCvETaUhXVzKbzA2m35zYz9o2SM18KgDBiViGHcnJ8ze3T6h1ihWgiKqoH68Tf6H2yWs4ppiP8cGvL38W7A9ViLqG+4SvbtfbNqQPX1fujcWcyJtFkEn5wGtPxGbG7f49Yx5+QgbNcrizAOQMvFskbjGFl2WQCK0RPHM67lM5/reQ6Px0aZZdZhR+KjVgyLvvRaocOyJrMLV07pCpBeTyaRP7b85Zsl4IDlctXnk3lpN2QG9coR2PzUR43oVP+sgw/jOT2JS0kJJNJ+fqSEduROfBiXDuTK2DrIsk836aU/5cFwHxF4erBvgF56VOyDF7SwAyQ2zDs+/l3x9jGsrkb2hcM/tSqJEUFVImhUAkvJKHT3tCpBvl5m+yptXPZt9OA8JFaTX9NSSfMhzfNPOUE6EBMDg+j5fJml3xELXW9r0Gppwff0yhba1x1r+NwZ61yV+Ty2EO+mJqZlb9l3PeZKiOhWoAvL3o2Kx9ohO3BJFWvHqEWBroTBzSspCMYjmAV5Q1gOF6uS7/ECAebLxA+QyNsd/r/A7MPsSY0O6s87lwADxbPVYHpR3zt86al1hDk57h+yKqwLxT6onFTChZiJCGgv3F3xKGg1BFfOQviMU2822jXbtaDwR9qhD2Alp7M8RB5hXDhAEJXj09Oya8Y4XD0Ys0/YxiVBWPYQcPjE9KExPxQ0Z2p9nTKuuVblcHWYz3lDuOiPuhqfJWZX1DagjbphF/khJfYQMM/0Am/Xad8r07YTMGPeVI+pxH2gUb56sZg+FcL6v3I+nD4Szrh/RlqZUQnfDueIyz2eypVVVVHNwSD3/VRdrZO+Rr5GByeq51/rYNhbrDQZKUGYT6NsGqdsi3ybwN8OQyIBf88od7Cvi+3LA3fiuq4BfUFVVBBBRVUUEEFFVRQQQWeLPgf9KAmcTONhtQAAAAASUVORK5CYII="
                        alt="whatsapp--v1">
                    <p class="hidden sm:block text-xs sm:text-sm text-gray-600 hover:underline">
                        {{ $company->phone }}
                    </p>
                </a>
                <span class="hidden sm:block bg-gray-400 w-[1.5px] h-8"></span>
                <a href="mailto:{{ $company->email }}" class="flex justify-center gap-3 hover:scale-110 transition duration-300 sm:hover:scale-none sm:transition-none">
                    <img
                        class="w-10 sm:w-5"
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAAFEElEQVR4nO2cbVcaRxTHedP2u/Th+yVqGpNUkzYxFVDRKqKiosT4HGsUiU8ICMwgLuzITj9E25z2jc3tmS2kRhY17sDsuvd3zv8czxHYvfe/e+fOzJ71+RAEQRAEQRAEQRAEQRAEQRAEQRAEQRCkxon+23eUGX7CuEYYf08ZBy+LMP5e5IIyo79Y4d+2LPHVavUrqhtDRDf+UR00dap045zofEDTtC+lJ58wnlQeIHOHiG7sSDWBMiOkOijqMhHGg9JqPpYd/vnSjXNaNr6xbcBS8vB1oVJVHxBzl0TOFrcPX9k2oHc09vfT8Bzs5UvKg6IukciVyFnv2Oxftg3oDEY+3Osfg47AOMy/3VUeHHW4lnZS0BUcB5GzruD4B9sGiB+6qIHYCmQ1XXmg1GESORG5uZwv6QYIPR6JwtZRQXnQ1CFKZAk8GZluyJMUA1Z30/BgcKLhh+/7wzC5ugUF3VCeAKpIRDdgdiMJHf5wQ34eDERgOZmyb4A40CHV4MXEK0uHn0/MwwHRlCeDtlkpWoa+qQXLnPwUmYd9cmp+TooBdbej6wnzyr98wK6BCKy8SylPCm2T1vYy8HBwsrEq9I9BeGkTCpX/q4I0A+raTOXgUWjK0vlQfA1y5bs7Z8iXq2aCrWLvDk3BxsFxw3ekGyCUKekQmFm2PJGe0Rgkj4vKk0Ulazd/As/CMcuY+6OLkC5VLL/XEgOECOOwkNiHzlrPe1GdgXFzcBJlS3XiqE19jDMQuVWcLTPA7pXhBmVKOgRnl2zd6S034Ca18dfDxtrodL09ysOjYftjXVsMqGttL33j7sCpIpK7vbYaIJQqalf2xwe1/tiJShU1eDHZbL4Tv9V8p+0GXHcV1WeIqpNNL+mqGb95996yoVBiwE3WSAbnVuD4lClP/LF2BqMLG9CqNS+lBpgBnjIYml+1DPDJyDQkMkRZ8pPHFHp+mbE8t2BsGbISLhDlBlitk1++xaPribbOGURvL/Y2OgKNJVL2vodjDKjvFD0bn7O84n6Ovoajk9bPGdInFfDPLFqeQ+/YLOzm5M7iHWVAfa9UDGr3LRLwcGgS3hxkWpb8zcMcdIeiTXv7fOVM+jEdZ0Bdb/az8L1V11GbM+QlPghQuKorG5yAld10y0x3rAFC6VIF/NPW5eDpWMxc5rB7jL1CCX5sUvZeTi3AUbG1Zc/RBtBrBkSx0GdnQPxv4I8oHfgdbwCtaSdL4IcmLeHnPgiQ084gNL9m3dsPT8N2un372a4xgNYTF2+euK0bJE7MK2QZ6TkDqI3S8bGU+eWXMs8ZQGsPAjyPxK0XxiJx8//1z6aKZehrsogmBuD9grqn+lxrAL1uUU+0j++OYH0/07Z21nMG0JrEhk73kPXmiJXEZ52yCXQnDKC17UH/jPX24Ce9fZuWNDxnAL0w0IrNcCcs6nnOAFqT2AzvGZ39dFk7q25Z23MGUDFnKJ/BcHzdlPhb9fl4zgDqEqEBDA3wtHxoAEcDvCwfGsDRAC/LhwZwNMDL8tmFMP6H6iCoW6Xz3+3fATovKw+EuVOEGaf2DWBGv+pAqEtFdN5n2wDxGi7z1SsOCIi67e1Z1erXPhmI13ApD4i5TYbfJwvx+i2qGwn1QXF3SDe28/n8F9IMqJsgXsOF5YhflfhzceVLT/5FxGu4iM5fihGeMP6n8qCZWokcmLnQeZ+0mo8gCIIgCIIgCIIgCIIgCIIgCIIgCIL47gL/AsoBhq774BcXAAAAAElFTkSuQmCC"
                        alt="secured-letter--v1">
                    <p class="hidden sm:block text-xs sm:text-sm text-gray-600 hover:underline">
                        {{ $company->email }}
                    </p>
                </a>
            </div>
        </div>
      </div>

      <!-- Banner Section -->
        <div class="relative w-full h-64 sm:h-80 lg:h-[400px] rounded-md overflow-hidden shadow">
            <!-- Gambar Background -->
            <img src="{{$company->banner}}"
                alt="Banner {{ $company->name }}"
                class="absolute inset-0 w-full h-full object-cover opacity-30">

            <!-- Teks Overlay -->
            <div class="absolute inset-0 flex items-center justify-center">
                <h2 class="text-xl sm:text-2xl lg:text-4xl font-bold text-gray-700 text-center max-w-4xl p-4">
                    Explore some of our products and find what you’re looking for only at
                    <span class="text-blue-600">{{ $company->name }}</span>
                </h2>
            </div>
        </div>

      <!-- About -->
        <div class="space-y-4 sm:space-y-0 sm:space-x-6 xl:space-x-7">
            <img src="{{ $company->logo ?? 'https://res.cloudinary.com/dypiyksms/image/upload/v1754490991/placeholder_dvwraw.png' }}" alt="{{ $company->name }}" class="w-full sm:w-1/5 sm:float-start rounded-md object-cover">
            <p class="text-base sm:text-lg lg:text-xl text-gray-600 text-justify">
                {{ $company->description }}
            </p>
        </div>

      <!-- Featured Products / Categories -->
      @if ($products->count())
        <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-6">Our Products</h2>

        <div class="space-y-12">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6">
                @foreach ($products as $product)
                <a href="{{ route('product.show', $product->id) }}" class="bg-white rounded-lg shadow-sm hover:shadow-md transition p-4 flex flex-col">
                    <div class="flex justify-center">
                        <img src="{{ $product->image ?? 'https://res.cloudinary.com/dypiyksms/image/upload/v1754490991/placeholder_dvwraw.png'  }}" alt="{{ $product->name }}"
                        class="h-25 md:h-40 sm:w-full object-cover rounded mb-3">
                    </div>
                    <h3 class="text-base font-semibold text-gray-800 truncate">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-500 mb-1 truncate">{{ $product->category->name ?? '-' }}</p>
                    <span class="text-blue-600 font-bold text-sm">Rp. {{ number_format($product->price, 0, ',', '.') }}</span>
                </a>
            @endforeach
                <div 
                    class="flex flex-col items-center gap-4 lg:gap-10 col-span-2 sm:col-span-3 lg:col-span-2 lg:col-start-3 justify-center">
                    <p class="text-sm sm:text-base text-gray-600">Explore our wide range of products</p>
                    <a href="{{ route('product.index') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-2 rounded-full text-sm transition">
                        View All
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-10 text-gray-600">
          Products not found.
        </div>
        @endif
    </div>
</section>
@endsection

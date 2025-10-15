<footer class="bg-gray-900 text-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-8">
            <!-- Logo -->
            <div class="sm:flex sm:justify-center sm:items-center">
                <img src="{{ $company->logo ?? 'https://res.cloudinary.com/dypiyksms/image/upload/v1754490991/placeholder_dvwraw.png' }}" alt="{{ $company->name }}" class="h-20 object-cover">
            </div>

            
            <!-- Company Info -->
            <div class="pr-4 lg:pr-12">
                <h3 class="text-lg font-semibold mb-4">Our Company</h3>
                <p class="text-sm leading-6">
                    We provide the best products for your needs. Quality and customer satisfaction are our priorities.
                </p>
            </div>

            <!-- Contact -->
            <div class="pr-4 lg:pr-12">
                <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-center gap-2">
                        <img
                            class="w-5"
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAAD+klEQVR4nO2cTYhWVRjHXx1nVFT8IAxS/IhUSJFI0hAhRRCRXCi6aNNGcCu0adFCFyEiGiW6iKCFyyHaRCFoKigqoiZNUpK6sA9SiRxL82PGn5y8A8PlTvOeZ86959w7/x+8y/c8H/9zzznPOefeVksIIYQQQgghhBBCCCGEECIH8CqwH/geuIvozXKxz+WmzMSPB/YC/bEjTpgnmRBdoZPfAXwZO7oa8Y3rsCEF+DB2RDXkvZAC/B47mhpyIqQAv8SOpoZ8EVKAD2JHUzMeAG+GFGAMsBN4HDuyGvATsDJY8nNCLAS+jR1horjOuQeYUEryc0/Du8Cd2BEnxGlgcamJLxBiBvAp8JTRy11gBzC20uTnhHgL+JHRx1fA7FYKuHEP2AU8pPn8BmxupQiwADhKM+nPhtwprZQZNEnfpjlcBpa36gQwvQGT9INsaO2MmchxwNvAKte7Df9fkxUnddzRnGeI9wVgN/BxkEka+HyQU8eBRcazhJ01maT/AN4JVB+d822nqGH3GA7mYfZYTjBW0k7EFHkKfOaGTkNcrwDHCtrs922rqPGhuAasM7a5FbhFOvwMrDUOz64Q+2eohi35yRsZjm5gpnGS/iTyEefA/o336RXwOnBxOAO+7RYZaoe/rCU5zyf3H4izf+N9iA5MzTpOXztGfNsvMujDKcumFNA53KMckJF0lo3ATR9jvjaKjFoea9dDJhlsvQwcodz9m1kGv15yJ1wWg762ioxbuQ6sN9rcCPxKOFxbmwx+jAW2A/eshi3x552IsmsITAswSZv3b4Clbh0/0uB97RY5EnLc7TDYXwn0GPdv3jDYm5jVOY9CBO5rv8ihkFwAlo1gvf13GzbuA+8bxV4NXA0ZsK8PRU6VcX3PDS2TDb7Mz/ZohuJrYK6h3ReBwyXEmqQAA9wANhh92gyczVZc7nfGOMm6/ZttwJ9lBWmJL+9k2XS7ZZ7RNzc0jTP+dxFwsuzgLL7lHa3ycLtjxA63V/S5OeLfKgIL4XCVXLKsXDy3Pa5UGVAIp6vmSTZJBzt7DVRTmAjhfMzbB1sC+B+6qh41AgyupOcY/J6VwkslTRDAq7jyLNpKpykCDPAdsOJ/fH0NOE9CNE0AsoOQQ64qzlXIB9s9JKmSJgqQv8HgfsnSdAGSRwJERgJERgJERgJERgJERgJERgJERgJERgJERgJERgJERgJERgJERgJERgI0QIAkzlZrSm8IASq9yNQwekII4N74Fjb2hxBgSYqH3TWgL9hXtLJbCMKPA0GSnwnQpY/1eXGsjO9Hd6V69yYhXG4OBE9+TojFwEfZi3NaovJfDnqynFT75UQhhBBCCCGEEEIIIYQQQrTqwDN2twQwiVuq1wAAAABJRU5ErkJggg=="
                            alt="mail">
                            <a href="mailto:{{ $company->email }}" class="hover:underline">{{ $company->email }}</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <img
                            class="w-5"
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACEElEQVR4nO3ZzYtNYRzA8Z/XUWJDGKJk5WUpWUrsyEYUNanBn6D8BbLDCv+BxcR4jSxQkxoLRnmLImXl5UZIqI9OcxY3Zu7c59zuuc9kPn/B/fac+5zn+Z2IGTN6B3swii94gK0xnWAezvpXA6tiOsAiXDe5a5E7rMQTUxuIXGE5XmjPJ/RHbjAfI9IMR25wXDUHIyd4UzHkA1ZELvBVdUORC7zUmf2RAwx1GPI8coCjHYZ8jxxgGX53EHI/coHbHYQM5HbSreIRZkcuMAtjFUJ2Rm6wLzHicuTI+KrcSwgZjFxhI34mnILXRa5wMmFVHmJh5Ah95Q9sV7F190WOsAHfEmIuYm7kCEekOV9sGJEjE09TWjkVGY+G7iTGnM5yZYwPJl5VeMzmRG6wBm8TYy5hQeQGm/AxMebmRO+ZYrVwqBzF/sKz4ohUZ8yWchacYqz5BIDtLd5TV4pBYV0xO/AjMaY4zgziapvTmQN13l9SY1T4j/XXEbOtwmOWqlHMFOqI2Yz3uu8GVtdx9H9XQ0yj2Gy6HbO2wkuzitGuhjSNlVJumFV87npI0yeKc10MGaklpCnocOJ9pl27ag0pY9Yn3jSncqb2iL+uzScSBhqttt/e30DLLfquah5jcWQ2N9ub+Lg9Le5DkaMyaDdulUf4yRRb+dKYDrCkPBVfKD4YlZ8BX+NYcc3u9e+b8d/6A8BzVur0abPMAAAAAElFTkSuQmCC"
                            alt="phone">
                            <a href="https://wa.me/{{ $company->phone }}" class="hover:underline">{{ $company->phone }}</a>
                        </li>
                        <li class="flex gap-2">
                            <img
                            class="w-5 h-5"
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAAsTAAALEwEAmpwYAAAE0UlEQVR4nO3dW4hWVRTA8dV4SXLGiiysoPukD0GShdFjIDmGRpQEJWaUXV66PhTdn4puBl7eyofUrCBoJuohskSI7OaDGT05pNOYeSVLytL5x8YdRKTON7PX2Wvt/f1gYPiG+VjrOzNnn73XOvuItLW1FQA4C7gJeAZYC3wD9AP7gD/j1774WvjZm8DT8XfOzB1/EYAZwCvAt8AQIxd+d3N8ryty5+UK0AU8DGxBT3jvh4DO3PmaBZweT0d7ac6eeFo7LXf+ZgAnAQuBn8kn/BHcHWKRmgEXAhuwYz1wgdQIuCFeFVnzCzBfKjtFvYBtQ8BzxZ/CgDHAa/jxBjBOShQSA3rx5z1grBR4mlqJX6uLOn05GDOG43kpATB3lMseVoQcbhTPgPMannlr2x/mTuJ43LA06UvlU5fjCbCIct0mDhcKd1Gun4BJ4gXwLOV7QjwAJgK7Kd8eF/WUWFyqxYNiXSyV1mKLWAZcSX0uF6uAJQ19CNuBZcBsYFoctybG78Nry4GBhmJ5UayK3SGafoyl1hOuvgIdodAE/KAc0yYx3DeluWbVGzpSRtjF0qcY1xFgslgTG9K0LA1/8aOIrSO+hxZ7i46xhUfDh6HSmCC+DsUC2ZNiTWzd1BgzuhLGGE5fgwpxrhZrgK8VEr1TIc7FCnF+KdYoXM1sT3Gq+p84xypcEveLNQqFqKWKsYZ5Skq7xRrgUOIkexRjnZM41j/EGuBw4iS7FWOdmjjWv8Qa4LfESXYqxtqZONYDYo1ChbBLMdZw+ZvSTrEG+D5xkpcqxhoWIVPaLNbEVv5aB/WPxZrYbpnScsVYVySOdaVYAzyeOMkBRxPDR8QaYB7p3aUQ5z0Kcc4Sa4CLFBIdTLy4OAnYoRDn2WK0dfSA8eX3PoX49opVwEbqK1CtE6uAl9DTN8ISbjhNva8Y11NiVez40LQLeKCFJoeFSmPGv80Uq4BTwson+gbiEnpPnHV3xq9pcdK3oqE2oP0al+ZJxfsnavGuWBcK/tTjXrEOmE4djgDnigfAd5TvE/EibnlUusXiBXBxIbdCH0vYTvAM8ST0KlGuXvEm3F1EueaLN2HbPIXGBwsG3e4Q5GwrJv9rVxXOSQ4BU8Qz4DPKsUq8A26lHDOlkJ3kwvbf3q2TUgD34d+1Ugrg5Hg3lFcbpTRxr3WvrpfSxGpizu3ER2qTyw3LCv4v6ZFSAeOBrfixXkoHLMCHIeBqKV1szwmPJLLubakFcB32C1DdUhPgA+x6WWoDXNJQU12rdgKnSo3CfurYc7vUKk4WtTcYa8VXo+myLwJwCzYcDntG5v48TFDe8W24Xs39OVh7isKv5LPNxabIFbUNzcudv9UHhn2R4WC8lTt3s4DLGp6bhHJA+0nSxwM82uABuTl3vl4WHzc0cDDW5M7VDaAbOKh4MHa4617PDZ0tMP6pc8zOnZ9L6OwFXN9KbuIO+v6EByMUxsbnzss14KpEO56GWyOm5s6nCMBjCQ7Iotx5lHYp/NEoDsY7uXMoDjAlVvNatbXaCqA24JoWx5PfgRm54y4acH8LB+SO3PFWAXh9GAdjWe44qwFMOMF98J+35xsNA84/xiAfbls+J3d8VeLogywP/mcQ938foGcc3UFuW2wnmpM7nra2NlH0NwrlaFY6JmdyAAAAAElFTkSuQmCC"
                            alt="marker">
                            <a href="https://maps.app.goo.gl/hJ8KLDYWcpPt5vJN6" class="hover:underline">{{ $company->address }}</a>
                        </li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div class="pr-4 lg:pr-12">
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-blue-400">Home</a></li>
                        <li><a href="{{ route('category.index') }}" class="hover:text-blue-400">Categories</a></li>
                        <li><a href="{{ route('product.index') }}" class="hover:text-blue-400">Products</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-blue-400">Cart</a></li>
                    </ul>
                </div>
        </div>

        <!-- Footer Bottom -->
        <div class="mt-8 border-t border-gray-700 pt-4 text-center text-sm">
            &copy; {{ date('Y') }} {{ $company->name }}. All rights reserved.
        </div>
    </div>
</footer>

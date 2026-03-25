use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
  public function redirect($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider) {
        $socialUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName(),
                'password' => bcrypt(str()->random(16)),
                'role' => 'citizen',
            ]
        );

        auth()->login($user);
        return redirect('/dashboard');
    }
}
点击这里,重置你的密码:  <a href="{{ $link = url('/admin/password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>

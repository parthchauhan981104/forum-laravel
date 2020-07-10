<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Discussion Forum

Channels->Discussions->Replies->Likes
Discussions on multiple channels. Replies on Discussions, discussion owner can mark best reply. Likes on Replies. 
Notifications/verification emails are queued as jobs. Use <strong>php artisan queue:work</strong> to process them.
Notifications are sent out as In-app/Email to:
<ul>
    <li>
       Discussion author - When a reply is recieved on a discussion. 
    </li>
    <li>
        Reply writer - When discussion author marks their reply as the best reply.
    </li>
</ul>

3rd party services used: Gravatar, trix-editor.
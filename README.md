# linkstash

Petit gestionnaire de bookmarks (API JSON).

```bash
php -S 127.0.0.1:8080 -t public
```

- `GET /` — infos de l'app
- `GET /bookmarks` — liste des bookmarks
- `POST /bookmarks` — ajoute un bookmark (`{"title": "...", "url": "..."}`)

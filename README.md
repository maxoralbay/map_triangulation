### Install

```
git clone dev_url
cd phpdocker
docker-compose build
cd project
cp .env.example .env
cp public/.env.example public/.env
cd ..
docker-compose up -d
sh build.sh
```

### Development

```
sh shell.sh ### enter the container
sh dev.sh ### run the development server
sh build.sh ### build the project
```

### API

Endpoint for calculate the expression

```
localhost/api/calculate ### calculate
```

Parameters:

```json
[
  {
    "points": [
      {
        "lon": 50.110889,
        "lat": 8.682139
      },
      {
        "lon": 39.048111,
        "lat": -77.472806
      },
      {
        "lon": 45.849100,
        "lat": -119.714000
      }
    ],
    "distance1": 34,
    "distance2": 45,
    "distance3": 56
  }
]
```

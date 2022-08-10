# Tic-Tac-Toe API

## Installation

### Requirements

1. Docker
2. Docker-compose

### Project set-up

For project set-up or local development, docker can be used.
To achieve compliance with the environment at all stages (locale, development, stage, prod) same Dockerfiles are used.
Container names, their network name, db initial params and app admin credentials are getting from .env file.
To succeed project setup you need to run
```
cp .deploy/.env.example .deploy/.env
```
and fill it up with data.

After that you have to run
```
cp .env.example .env
```
and fill it up with data.

**Warning: db variables in .deploy/.env and .env has to match.**

Now, everything is ready to run project  by
```
# docker-compose -f .deploy/docker-compose.yml up -d
```

## API endpoints

This service provides a player-vs-player game mode. All communication is handled by endpoints, and all data are be returned as JSON.

### Get game status

It returns the game state. It should initialize a new game if no game has been started before.
```
GET http://localhost:8088/api/

Response body:
{
    "board": [
        [piece, piece, piece],
        [piece, piece, piece],
        [piece, piece, piece]
    ],
    "score": {
        "x": number,
        "o": number
    },
    "currentTurn": "x" | "o"
    "victory": piece
}
```

### Place the piece

Should place the piece (either x or o) in the requested grid coordinates.
```
POST http://localhost:8088/api/:piece

Request body
{
    "x": number,
    "y": number
}

Response body:
{
    "board": [
        [piece, piece, piece],
        [piece, piece, piece],
        [piece, piece, piece]
    ],
    "score": {
        "x": number,
        "o": number
    },
    "currentTurn": "x" | "o"
    "victory": piece
}
```

### Restart game

Should clear the board and update the score based on who won (the victory variable). If nobody had a victory in the previous game, it basically clears the board without touching the scores.
```
POST http://localhost:8088/api/restart

Response body:
{
    "board": [
        [piece, piece, piece],
        [piece, piece, piece],
        [piece, piece, piece]
    ],
    "score": {
        "x": number,
        "o": number
    },
    "currentTurn": "x" | "o",
    "victory": piece
}
```

### New game

Should clear the board and scores.
```
DELETE http://localhost:8088/api/

Response body:
{
    "currentTurn": "x" | "o"
}
```

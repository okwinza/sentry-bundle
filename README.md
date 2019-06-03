# Sentry integration for Symfony

Install this package, enable the bundle if Symfony Flex didn't do it for you
and update the `config/packages/prod/monolog.yaml`:

```yaml
sentry:
    dsn: '%env(SENTRY_DSN)%'

monolog:
    handlers:
        main:
            type: fingers_crossed
            action_level: error
            activation_strategy: 'citepolitique.sentry.activation_strategy'
            handler: nested
        nested:
            type: group
            members: [file, buffer]
        file:
            type: stream
            path: '%kernel.logs_dir%/%kernel.environment%.log'
            level: debug
        buffer:
            type: buffer
            handler: sentry
        sentry:
            type: service
            id: 'citepolitique.sentry.monolog_handler'
        console:
            type: console
            process_psr_3_messages: false
            channels: ['!event', '!doctrine']
        deprecation:
            type: stream
            path: '%kernel.logs_dir%/%kernel.environment%.deprecations.log'
        deprecation_filter:
            type: filter
            handler: deprecation
            max_level: info
            channels: ['php']
```

Then update the `.env` file to add:

```
SENTRY_DSN='https://xxx@sentry.io/xxx'
```

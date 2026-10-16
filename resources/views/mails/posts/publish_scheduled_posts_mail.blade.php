<x-mail::message>
# @lang('Hello Admin')

@lang('Posts for date :scheduledDate have been published. The publication date for these posts has been set as :date.', [
    'scheduledDate' => $scheduledDate,
    'date' => now()->format('Y-m-d')
])

<br/>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

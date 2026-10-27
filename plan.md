# Goals 
- dashboard to view logs
- ability to set alerts for log types. 
- ability to assign users roles (dev,viewer,admin)
- ability to create api keys 
- sdk to use in laravel (v1) and js projects 
- ability to sign up 
- ability to register
- set how long logs are save or archieve them. 
- filter by time 2hr, 24hr, 7D, 14D, 30D
- zoom into graph to see a specific portion of the graph. 
- view single exceptions
- view a single requestion 
- whats holding up the issue 
- see jobs, notification,commands, dataconnection, queries, Mail,Cache
# Dashboard user stories (agreed 2026-10-15)

## All charts
1. **Time range filter** — presets 1h / 24h / 7d / 14d / 30d, or a custom date / date range.
2. **Draw-to-zoom** — draw a highlighted box over any chart; on release it zooms automatically (no button).
3. **Reset zoom** — a button returns to the selected time range.
4. **Dashboard stays in sync** — any time range change (filter, zoom, clicking the dominant exception) updates every section.
5. **Bar charts by default** — request duration may be a line chart.

## Activity
6. **Requests overview**
   - Header: total requests + counts for 1xx, 2xx, 3xx, 4xx, 5xx.
   - Bar chart of requests over time, split by status group (pass = 2xx/3xx, fail = 4xx/5xx).
   - Hover: date/time, total, count per status group.
7. **Request duration**
   - Header: average and P95 duration.
   - Chart (line allowed) of average and P95 over time.
   - Hover: date/time, total requests, status group counts, average, P95.

## Application
8. **Exceptions**
   - Bar chart of exceptions over time, split handled vs unhandled.
   - Summary: "X exceptions reported between [start] and [end]. X errors have impacted Y users." / "No exceptions reported in the last [range]" when empty.
   - Dominant exception box: the single exception type that impacted the most users — route, exception type, users impacted.
   - Clicking the box zooms the dashboard to when that exception happened. No exception detail page for now.
9. **Performance thresholds**
   - User sets a threshold per route, job, Artisan command, or scheduled task (in application settings).
   - Dashboard shows cards for items that exceeded their threshold in the range: what it is (method + route / job / command / task) and max duration.
   - Up to 3 cards shown, then they stack.
   - Button on the card opens the application settings page.
10. **Job attempts**
    - Header: total attempts, processed, released, failed.
    - Bar chart split by processed / released / failed.
    - Hover: date/time, total, processed, released, failed.
11. **Job duration**
    - Header: average and P95 job duration.
    - Bar chart of average and P95 over time.
    - Hover: date/time, average, P95.

## Users
12. **Users impacted by exceptions** — bar chart of exceptions vs users impacted over time.
13. **Active users** — bar chart of authenticated users over time; hover: total users + time range.
14. **User requests**
    - Header: total, authenticated, guest requests.
    - Bar chart split by authenticated vs guest.
    - Hover: authenticated, guest, total + time range.

## Later (separate pages)
- Requests page (only requests open pages for now).
- Application settings page (general settings, environments, thresholds).\




function pagination_change(data)
{
	'use strict';
	if (data.page_id >= 1 && data.page_id <= data.max_page)
	{
		data.page_now = data.page_id;
	}
	else if (data.page_id === 'backward')
	{
		if (data.page_now > 1)
		{
			data.page_now = Math.max(1, data.page_now - 1 - data.step);
		}
	}
	else if (data.page_id === 'previous')
	{
		if (data.page_now > 1)
		{
			data.page_now--;
		}
	}
	else if (data.page_id === 'next')
	{
		if (data.page_now < data.max_page)
		{
			data.page_now++;
		}
	}
	else if (data.page_id === 'forward')
	{
		if (data.page_now < data.max_page)
		{
			data.page_now = Math.min(data.max_page, data.page_now + 1 + data.step);
		}
	}
}

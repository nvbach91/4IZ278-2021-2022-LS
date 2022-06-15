import {DateTime} from "luxon";

export const getDateRange = (date: DateTime, type: 'day' | 'week' | 'month' | 'year') => {
  return {from: date.startOf(type).toUTC().toFormat('yyyy-MM-dd HH:mm:ss'), to: date.endOf(type).toUTC().toFormat('yyyy-MM-dd HH:mm:ss')};
}

// functions/subscribe.js
const mailchimp = require('@mailchimp/mailchimp_marketing')
const crypto = require('crypto')
const qs = require('querystring');

const { MAILCHIMP_API_KEY, MAILCHIMP_SERVER_PREFIX, MAILCHIMP_LIST_ID } = process.env

mailchimp.setConfig({
  apiKey: MAILCHIMP_API_KEY,
  server: MAILCHIMP_SERVER_PREFIX,
})

const headers = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Headers": "Content-Type",
  "Access-Control-Allow-Methods": "OPTIONS,POST,GET",
}

exports.handler = async function(event, context) {
  // Hello our dear friend, CORS. Nice to see you.
  if (event.httpMethod === 'OPTIONS') {
    return {
      statusCode: 204,
      headers
    }
  }

  //const { email } = JSON.parse(event.body)
  console.log(event.body)
  console.log("---after parsing---")
  const { email } = qs.parse(event.body);
  console.log(email);
  console.log(MAILCHIMP_API_KEY)
  console.log(MAILCHIMP_LIST_ID)
  console.log(MAILCHIMP_SERVER_PREFIX)
  const subscriberHash = crypto.createHash('md5').update(email).digest('hex')

  try {
    const response = await mailchimp.lists.setListMember(
      MAILCHIMP_LIST_ID,
      subscriberHash,
      {
        "email_address": email,
        "status": "subscribed",
        "merge_fields": {}
      },
        { skipMergeValidation: true }
    )

    return {
      statusCode: 200,
      headers,
      body: JSON.stringify({
        status: response.status,
        email: response.email_address,
      })
    }
  } catch (e) {
      return {
        statusCode: 400,
        headers,
        body: JSON.stringify({
          status: 'error',
          error: e.response.body.title,
        })
      }
  }
}

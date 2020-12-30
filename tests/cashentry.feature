Feature: Cash Entry Payment Processor Option

Scenario: On a Contribution form with multiple processors one of which is a Cash Entry Processor and Permission

WHEN A user has the permission 'use Cash Entry Processors'
AND Is on a front facing Contribution (or event registration) Form
AND that form has multiple payment processors including one of the type "Cash Entry"
THEN that user can see and select the Cash Entry Processor

Scenario: On a Contribution form with multiple processors one of which is a Cash Entry Processor and NO Permission

WHEN A user does not have the permission 'use Cash Entry Processors'
AND Is on a front facing Contribution (or event registration) Form
AND that form has multiple payment processors including one of the type "Cash Entry"
THEN that user cannot see or use the Cash Entry Processor

Scenario: On a Contribution form with one processor of the type "Cash Entry" and Permission

WHEN a user has the permission 'use Cash Entry Processors'
AND is on a front facing Contribution (or event registration) Form
AND that form has one payment processor
AND that payment processor is of the type "Cash Entry"
THEN that user can access the contribution form

Scenario: On a Contribution form with one processor of the type "Cash Entry" and No Permission

WHEN a user does not have the permission 'use Cash Entry Processors'
AND is on a front facing Contribution (or event registration) Form
AND that form has one payment processor
AND that payment processor is of the type "Cash Entry"
THEN that user cannot access the contribution form

Scenario: Submitting a Form using a "Cash Entry" Processor

WHEN A user has the permission 'use Cash Entry Processors'
AND Is on a front facing Contribution (or event registration) Form
AND the user selects a payment processor of the type "Cash Entry"
AND submits the form
THEN a completed contribution will be created 

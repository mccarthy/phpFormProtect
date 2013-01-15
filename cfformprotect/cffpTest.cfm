<cfset cffp = CreateObject("component","cfformprotect.cffpVerify").init() />

<html>
	<head><title>test</title></head>
<body onload="document.frmAwesome.Submit.focus()">
<div style="border:1px solid black;padding:20px;margin:20px;">
	<form action="<cfoutput>#cgi.script_name#</cfoutput>" method="post" name="frmAwesome">
		<div>Name:<input type="text" name="FullName" id="FullName" value="<cftry><cfoutput>#form.FullName#</cfoutput><cfcatch/></cftry>"></div>
		<div><textarea name="Comment" style="height:100px;width:400px;"><cftry><cfoutput>#form.Comment#</cfoutput><cfcatch/></cftry></textarea></div>
		<div><input name="Submit" id="Submit" type="submit" value="submit" /></div>
		<cfinclude template="cfformprotect/cffp.cfm" />
	</form>
</div>

<cfif StructKeyExists(form,"FieldNames")>
	<div style="border:1px solid black;padding:20px;margin:20px;">
		<cfoutput>
		Overall Results:
		<cfif cffp.testSubmission(form)>
			Form submission was not spam.
		<cfelse>
			Form submission was spam.
		</cfif>
		<br /><br />
		Individual test results:<br />
		<ol>
		<li><strong>Mouse Movement test</strong>:
		<cfif cffpConfig.mouseMovement>
			<cfif cffp.testMouseMovement(form).pass>
				<em>pass</em>, movement was detected.
			<cfelse>
				<em>fail</em>, movement was not detected.
			</cfif></li>
		<cfelse>
			not enabled.</li>
		</cfif>
			<li><strong>Keyboard Usage test</strong>:
		<cfif cffpConfig.usedKeyboard>
			<cfif cffp.testUsedKeyboard(form).pass>
				<em>pass</em>, keystrokes were detected.
			<cfelse>
				<em>fail</em>, keystrokes were not detected.
			</cfif></li>
		<cfelse>
			not enabled.</li>
		</cfif>
		<li><strong>Timed Form test</strong>:
		<cfif cffpConfig.timedFormSubmission>
			<cfif cffp.testTimedFormSubmission(form).pass>
				<em>pass</em>, the form submission time was within the allowed time span.
			<cfelse>
				<em>fail</em>, the form submission time was not within the allowed time span.
			</cfif></li>
		<cfelse>
			<li>not enabled.</li>
		</cfif>
		<li><strong>Hidden Field test</strong>:
		<cfif cffpConfig.hiddenFormField>
			<cfif cffp.testHiddenFormField(form).pass>
				<em>pass</em>, the hidden field was empty as expected.
			<cfelse>
				<em>fail</em>, the hidden field was not empty.
			</cfif></li>
		<cfelse>
			not enabled.</li>
		</cfif>
		<li><strong>Akismet test</strong>:
		<cfif cffpConfig.akismet>
			<cfif cffp.testAkismet(form).pass>
				<em>pass</em>, Akismet doesn't think this spam.
			<cfelse>
				<em>fail</em>, Akismet thinks this is spam.
			</cfif></li>
		<cfelse>
			not enabled.</li>
		</cfif>
		<li><strong>Too Many Urls test</strong>:
		<cfif cffpConfig.tooManyUrls>
			<cfif cffp.TestTooManyUrls(form).pass>
				<em>pass</em>, there were not too many URLs in the form contents.
			<cfelse>
				<em>fail</em>, there were too many URLs in the form contents.
			</cfif></li>
		<cfelse>
			not enabled.</li>
		</cfif>
		<li><strong>Spam Strings test</strong>:
		<cfif cffpConfig.teststrings>
			<cfif cffp.testSpamStrings(form).pass>
				<em>pass</em>, the form contents did not contain too many spam strings from your list.
			<cfelse>
				<em>fail</em>, the form contents contained too many spam strings from your list.
			</cfif></li>
		<cfelse>
			not enabled.</li>
		</cfif>
		<li><strong>Project Honeypot test</strong>:
		<cfif cffpConfig.projectHoneyPot>
			<cfif cffp.testProjHoneyPot(form).pass>
				<em>pass</em>, Project Honeypot did not identify this as spam.
			<cfelse>
				<em>fail</em>, Project Honeypot identified this as spam.
			</cfif></li>
		<cfelse>
			not enabled.</li>
		</cfif>
		</ol>
		</cfoutput>
	</div>

</cfif>

</body>
</html>
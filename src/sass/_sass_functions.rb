
# ****************** CUSTOM SASS FUNCTIONS FOR TIMPLATE ****************** #

puts "====== DETERMINATION ======"

require "sass"
require "base64"

# **************************** base64Encode() **************************** #

# base64Encode for easy use into data URIs

	# added by CHROMATIX TM 03/08/2015
	# HT: http://stackoverflow.com/a/15455580/1982136

	module Sass::Script::Functions
		def base64Encode(string)
			assert_type string, :String
			Sass::Script::String.new(Base64.strict_encode64(string.value))
		end
		declare :base64Encode, :args => [:string]
	end
	
# ********************* The end, thanks for visiting! ********************* #

